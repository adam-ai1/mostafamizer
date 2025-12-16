<?php

namespace Modules\SmartUpdater\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SmartUpdater\Services\SmartUpdaterService;
use Modules\Addons\Entities\Envato;
use Illuminate\Support\Facades\Validator;
use Exception;

class SmartUpdaterController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new SmartUpdaterService();
    }

    public function index()
    {
        $data = [
            'currentVersion' => config('artifism.file_version', env('VOXCRAFT_STUDIO_VERSION', '1.0.0')),
            'backups' => $this->service->getBackups(),
        ];

        return view('smartupdater::index', $data);
    }

    public function analyze(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'required|mimes:zip,rar,7zip|max:512000',
            'purchaseCode' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => __('Please upload a valid zip file and provide your purchase code.'),
                'errors' => $validator->errors(),
            ], 422);
        }

        if (!Envato::isValidPurchaseCode($request->purchaseCode)) {
            return response()->json([
                'success' => false,
                'message' => __('Invalid purchase code. Please provide a valid Envato purchase code.'),
            ], 422);
        }

        try {
            $file = $request->file('attachment');
            $tempPath = storage_path('smart-updater/uploads');
            
            if (!file_exists($tempPath)) {
                mkdir($tempPath, 0755, true);
            }

            $filename = 'update_' . time() . '.zip';
            $file->move($tempPath, $filename);
            $zipPath = $tempPath . '/' . $filename;

            $analysis = $this->service->analyzeUpdate($zipPath);

            return response()->json([
                'success' => true,
                'data' => $analysis,
                'message' => __('Update file analyzed successfully.'),
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function install(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modules' => 'required|array',
            'modules.*' => 'string',
            'create_backup' => 'boolean',
            'config_files' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => __('Invalid request.'),
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $createBackup = $request->input('create_backup', true);
            $modules = $request->input('modules', []);
            $configFiles = $request->input('config_files', []);

            $result = $this->service->installModules($modules, $createBackup);

            if (!empty($configFiles)) {
                $configResult = $this->service->installConfigFiles($configFiles);
                $result['config_installed'] = $configResult['installed'];
                $result['config_failed'] = $configResult['failed'];
            }

            $this->service->cleanTempDirectory();

            $message = count($result['installed']) > 0
                ? __(':count module(s) installed successfully.', ['count' => count($result['installed'])])
                : __('No modules were installed.');

            return response()->json([
                'success' => true,
                'data' => $result,
                'message' => $message,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function backups()
    {
        try {
            $backups = $this->service->getBackups();

            return response()->json([
                'success' => true,
                'data' => $backups,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function restore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'backup_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => __('Invalid backup ID.'),
            ], 422);
        }

        try {
            $result = $this->service->restoreBackup($request->backup_id);

            return response()->json([
                'success' => true,
                'data' => $result,
                'message' => __('Backup restored successfully.'),
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteBackup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'backup_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => __('Invalid backup ID.'),
            ], 422);
        }

        try {
            $this->service->deleteBackup($request->backup_id);

            return response()->json([
                'success' => true,
                'message' => __('Backup deleted successfully.'),
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function cleanup()
    {
        try {
            $this->service->cleanTempDirectory();

            return response()->json([
                'success' => true,
                'message' => __('Temporary files cleaned successfully.'),
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
