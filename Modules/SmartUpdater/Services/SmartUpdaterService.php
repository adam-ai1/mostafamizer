<?php

namespace Modules\SmartUpdater\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use ZipArchive;
use Exception;

class SmartUpdaterService
{
    private $tempPath;
    private $backupPath;

    public function __construct()
    {
        $this->tempPath = storage_path('smart-updater/temp');
        $this->backupPath = storage_path('smart-updater/backups');
    }

    public function analyzeUpdate($zipPath)
    {
        $this->cleanTempDirectory();
        
        if (!File::exists($this->tempPath)) {
            File::makeDirectory($this->tempPath, 0755, true);
        }

        $zip = new ZipArchive();
        $res = $zip->open($zipPath);

        if ($res !== true) {
            throw new Exception(__('Cannot open the update file.'));
        }

        $zip->extractTo($this->tempPath);
        $zip->close();

        $updateArchive = $this->findUpdateArchive();
        
        if ($updateArchive) {
            $archivePath = $this->tempPath . '/' . $updateArchive;
            if (File::exists($archivePath)) {
                $innerZip = new ZipArchive();
                if ($innerZip->open($archivePath) === true) {
                    $innerZip->extractTo($this->tempPath . '/extracted');
                    $innerZip->close();
                }
            }
        }

        return $this->compareModules();
    }

    private function findUpdateArchive()
    {
        $updaterJsonPath = $this->tempPath . '/updater.json';
        
        if (File::exists($updaterJsonPath)) {
            $json = json_decode(File::get($updaterJsonPath), true);
            return $json['archive'] ?? null;
        }

        $files = File::files($this->tempPath);
        foreach ($files as $file) {
            if ($file->getExtension() === 'zip') {
                return $file->getFilename();
            }
        }

        return null;
    }

    private function compareModules()
    {
        $result = [
            'new_modules' => [],
            'updated_modules' => [],
            'update_version' => null,
            'current_version' => config('artifism.file_version', '1.0.0'),
        ];

        $updaterJsonPath = $this->tempPath . '/updater.json';
        if (File::exists($updaterJsonPath)) {
            $json = json_decode(File::get($updaterJsonPath), true);
            $result['update_version'] = $json['version'] ?? null;
        }

        $updateModulesPath = $this->tempPath . '/extracted/Modules';
        if (!File::exists($updateModulesPath)) {
            $updateModulesPath = $this->tempPath . '/Modules';
        }

        if (!File::exists($updateModulesPath)) {
            return $result;
        }

        $currentModules = $this->getCurrentModules();
        $updateModuleDirs = File::directories($updateModulesPath);

        foreach ($updateModuleDirs as $moduleDir) {
            $moduleName = basename($moduleDir);
            $moduleJsonPath = $moduleDir . '/module.json';

            if (!File::exists($moduleJsonPath)) {
                continue;
            }

            $moduleInfo = json_decode(File::get($moduleJsonPath), true);
            $moduleInfo['folder_name'] = $moduleName;
            $moduleInfo['source_path'] = $moduleDir;
            $moduleInfo['size'] = $this->getDirectorySize($moduleDir);
            $moduleInfo['files_count'] = $this->countFiles($moduleDir);

            if (!isset($currentModules[$moduleName])) {
                $result['new_modules'][] = $moduleInfo;
            } else {
                $currentVersion = $currentModules[$moduleName]['version'] ?? '1.0.0';
                $updateVersion = $moduleInfo['version'] ?? '1.0.0';

                if (version_compare($updateVersion, $currentVersion, '>')) {
                    $moduleInfo['current_version'] = $currentVersion;
                    $moduleInfo['new_version'] = $updateVersion;
                    $result['updated_modules'][] = $moduleInfo;
                }
            }
        }

        $result['new_configs'] = $this->findNewConfigFiles();

        return $result;
    }

    private function getCurrentModules()
    {
        $modules = [];
        $modulesPath = base_path('Modules');

        if (!File::exists($modulesPath)) {
            return $modules;
        }

        $moduleDirs = File::directories($modulesPath);

        foreach ($moduleDirs as $moduleDir) {
            $moduleName = basename($moduleDir);
            $moduleJsonPath = $moduleDir . '/module.json';

            if (File::exists($moduleJsonPath)) {
                $modules[$moduleName] = json_decode(File::get($moduleJsonPath), true);
            }
        }

        return $modules;
    }

    private function findNewConfigFiles()
    {
        $newConfigs = [];
        
        $updateConfigPath = $this->tempPath . '/extracted/config';
        if (!File::exists($updateConfigPath)) {
            $updateConfigPath = $this->tempPath . '/config';
        }

        if (!File::exists($updateConfigPath)) {
            return $newConfigs;
        }

        $currentConfigPath = config_path();
        $configFiles = File::files($updateConfigPath);

        foreach ($configFiles as $file) {
            $filename = $file->getFilename();
            if (!File::exists($currentConfigPath . '/' . $filename)) {
                $newConfigs[] = [
                    'name' => $filename,
                    'source_path' => $file->getPathname(),
                ];
            }
        }

        return $newConfigs;
    }

    public function installModules(array $selectedModules, bool $createBackup = true)
    {
        $installed = [];
        $failed = [];
        $backupId = null;

        try {
            if ($createBackup) {
                $backupId = $this->createBackup($selectedModules);
            }

            Artisan::call('down');

            foreach ($selectedModules as $moduleName) {
                try {
                    $this->installModule($moduleName);
                    $installed[] = $moduleName;
                } catch (Exception $e) {
                    $failed[] = [
                        'module' => $moduleName,
                        'error' => $e->getMessage()
                    ];
                }
            }

            foreach ($installed as $moduleName) {
                try {
                    Artisan::call('module:migrate', ['module' => $moduleName]);
                    Artisan::call('module:seed', ['module' => $moduleName]);
                } catch (Exception $e) {
                    \Log::warning("Migration/Seed warning for {$moduleName}: " . $e->getMessage());
                }
            }

            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');

        } finally {
            Artisan::call('up');
        }

        return [
            'installed' => $installed,
            'failed' => $failed,
            'backup_id' => $backupId,
        ];
    }

    private function installModule($moduleName)
    {
        $sourcePath = $this->tempPath . '/extracted/Modules/' . $moduleName;
        if (!File::exists($sourcePath)) {
            $sourcePath = $this->tempPath . '/Modules/' . $moduleName;
        }

        if (!File::exists($sourcePath)) {
            throw new Exception(__('Module source not found: :module', ['module' => $moduleName]));
        }

        $destPath = base_path('Modules/' . $moduleName);
        File::copyDirectory($sourcePath, $destPath);

        $publicModulesPath = public_path('Modules/' . $moduleName);
        if (File::exists(public_path('Modules'))) {
            File::copyDirectory($sourcePath, $publicModulesPath);
        }

        $this->enableModule($moduleName);

        return true;
    }

    public function installConfigFiles(array $configFiles)
    {
        $installed = [];
        $failed = [];

        foreach ($configFiles as $configName) {
            try {
                $sourcePath = $this->tempPath . '/extracted/config/' . $configName;
                if (!File::exists($sourcePath)) {
                    $sourcePath = $this->tempPath . '/config/' . $configName;
                }

                if (File::exists($sourcePath)) {
                    File::copy($sourcePath, config_path($configName));
                    $installed[] = $configName;
                }
            } catch (Exception $e) {
                $failed[] = [
                    'config' => $configName,
                    'error' => $e->getMessage()
                ];
            }
        }

        return [
            'installed' => $installed,
            'failed' => $failed,
        ];
    }

    private function enableModule($moduleName)
    {
        $modulesJsonPath = base_path('Modules/modules.json');
        
        if (File::exists($modulesJsonPath)) {
            $modules = json_decode(File::get($modulesJsonPath), true);
            $modules[$moduleName] = true;
            File::put($modulesJsonPath, json_encode($modules, JSON_PRETTY_PRINT));
        }
    }

    public function createBackup(array $moduleNames)
    {
        $backupId = date('Y-m-d_H-i-s') . '_' . uniqid();
        $backupDir = $this->backupPath . '/' . $backupId;

        if (!File::exists($this->backupPath)) {
            File::makeDirectory($this->backupPath, 0755, true);
        }

        File::makeDirectory($backupDir, 0755, true);

        $backupInfo = [
            'id' => $backupId,
            'created_at' => now()->toDateTimeString(),
            'modules' => [],
            'modules_json_backup' => null,
        ];

        $modulesJsonPath = base_path('Modules/modules.json');
        if (File::exists($modulesJsonPath)) {
            File::copy($modulesJsonPath, $backupDir . '/modules.json');
            $backupInfo['modules_json_backup'] = 'modules.json';
        }

        foreach ($moduleNames as $moduleName) {
            $modulePath = base_path('Modules/' . $moduleName);
            if (File::exists($modulePath)) {
                File::copyDirectory($modulePath, $backupDir . '/Modules/' . $moduleName);
                $backupInfo['modules'][] = $moduleName;
            }
        }

        File::put($backupDir . '/backup_info.json', json_encode($backupInfo, JSON_PRETTY_PRINT));

        return $backupId;
    }

    public function getBackups()
    {
        $backups = [];

        if (!File::exists($this->backupPath)) {
            return $backups;
        }

        $backupDirs = File::directories($this->backupPath);

        foreach ($backupDirs as $dir) {
            $infoPath = $dir . '/backup_info.json';
            if (File::exists($infoPath)) {
                $backups[] = json_decode(File::get($infoPath), true);
            }
        }

        usort($backups, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return $backups;
    }

    public function restoreBackup($backupId)
    {
        $backupDir = $this->backupPath . '/' . $backupId;
        
        if (!File::exists($backupDir)) {
            throw new Exception(__('Backup not found.'));
        }

        $infoPath = $backupDir . '/backup_info.json';
        if (!File::exists($infoPath)) {
            throw new Exception(__('Backup info not found.'));
        }

        $backupInfo = json_decode(File::get($infoPath), true);
        $restored = [];

        try {
            Artisan::call('down');

            if ($backupInfo['modules_json_backup']) {
                File::copy(
                    $backupDir . '/modules.json',
                    base_path('Modules/modules.json')
                );
                $restored[] = 'modules.json';
            }

            foreach ($backupInfo['modules'] as $moduleName) {
                $backupModulePath = $backupDir . '/Modules/' . $moduleName;
                if (File::exists($backupModulePath)) {
                    $destPath = base_path('Modules/' . $moduleName);
                    
                    if (File::exists($destPath)) {
                        File::deleteDirectory($destPath);
                    }
                    
                    File::copyDirectory($backupModulePath, $destPath);
                    $restored[] = $moduleName;
                }
            }

            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');

        } finally {
            Artisan::call('up');
        }

        return [
            'success' => true,
            'restored' => $restored,
        ];
    }

    public function deleteBackup($backupId)
    {
        $backupDir = $this->backupPath . '/' . $backupId;
        
        if (File::exists($backupDir)) {
            File::deleteDirectory($backupDir);
            return true;
        }

        return false;
    }

    public function cleanTempDirectory()
    {
        if (File::exists($this->tempPath)) {
            File::deleteDirectory($this->tempPath);
        }
    }

    private function getDirectorySize($path)
    {
        $size = 0;
        $files = File::allFiles($path);
        
        foreach ($files as $file) {
            $size += $file->getSize();
        }

        return $this->formatBytes($size);
    }

    private function countFiles($path)
    {
        return count(File::allFiles($path));
    }

    private function formatBytes($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
