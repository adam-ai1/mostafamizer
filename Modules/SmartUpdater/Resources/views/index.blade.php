@extends('admin.layouts.app')
@section('page_title', __('Smart Updater'))

@section('css')
<style>
.smart-updater-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
.card-header-custom { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px 10px 0 0; padding: 20px; }
.card-header-custom h4 { margin: 0; font-weight: 600; }
.card-header-custom p { margin: 5px 0 0; opacity: 0.9; font-size: 14px; }
.upload-zone { border: 2px dashed #ddd; border-radius: 10px; padding: 40px; text-align: center; transition: all 0.3s ease; cursor: pointer; background: #f8f9fa; }
.upload-zone:hover, .upload-zone.dragover { border-color: #667eea; background: #f0f4ff; }
.upload-zone i { font-size: 48px; color: #667eea; margin-bottom: 15px; }
.module-card { border: 1px solid #e0e0e0; border-radius: 10px; padding: 20px; margin-bottom: 15px; transition: all 0.3s ease; background: white; }
.module-card:hover { box-shadow: 0 5px 20px rgba(0,0,0,0.1); transform: translateY(-2px); }
.module-card.selected { border-color: #667eea; background: #f8f9ff; }
.module-card .module-icon { width: 60px; height: 60px; border-radius: 10px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; }
.module-card .module-info h5 { margin: 0 0 5px; font-weight: 600; color: #333; }
.module-card .module-info p { margin: 0; color: #666; font-size: 13px; }
.module-card .module-meta { font-size: 12px; color: #888; }
.module-card .module-meta span { margin-right: 15px; }
.badge-new { background: #28a745; color: white; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.badge-update { background: #ffc107; color: #333; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.backup-card { border: 1px solid #e0e0e0; border-radius: 8px; padding: 15px; margin-bottom: 10px; background: white; }
.backup-card .backup-date { font-weight: 600; color: #333; }
.backup-card .backup-modules { font-size: 12px; color: #666; }
.btn-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; padding: 10px 25px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; }
.btn-gradient:hover { transform: translateY(-2px); box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4); color: white; }
.btn-outline-gradient { background: transparent; border: 2px solid #667eea; color: #667eea; padding: 8px 20px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; }
.btn-outline-gradient:hover { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
.analysis-result { display: none; }
.analysis-result.show { display: block; }
.version-badge { background: #e8f4fd; color: #0d6efd; padding: 5px 15px; border-radius: 20px; font-weight: 600; font-size: 14px; }
.loading-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.9); display: none; align-items: center; justify-content: center; z-index: 9999; flex-direction: column; }
.loading-overlay.show { display: flex; }
.loading-overlay .spinner { width: 60px; height: 60px; border: 4px solid #f3f3f3; border-top: 4px solid #667eea; border-radius: 50%; animation: spin 1s linear infinite; }
@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
.loading-overlay p { margin-top: 20px; font-weight: 600; color: #333; }
.alert-custom { border-radius: 10px; border: none; padding: 15px 20px; }
.alert-warning-custom { background: #fff3cd; color: #856404; }
.alert-info-custom { background: #d1ecf1; color: #0c5460; }
.nav-pills-custom .nav-link { border-radius: 25px; padding: 10px 25px; color: #666; font-weight: 500; }
.nav-pills-custom .nav-link.active { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
.empty-state { text-align: center; padding: 40px; color: #888; }
.empty-state i { font-size: 64px; margin-bottom: 15px; opacity: 0.5; }
.select-all-container { background: #f8f9fa; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; }
</style>
@endsection

@section('content')
<div class="smart-updater-container">
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
        <p id="loadingText">{{ __('Processing...') }}</p>
    </div>

    <div class="card mb-4">
        <div class="card-header-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4><i class="feather icon-download-cloud mr-2"></i>{{ __('Smart Module Updater') }}</h4>
                    <p>{{ __('Install new modules selectively without affecting your existing customizations') }}</p>
                </div>
                <div>
                    <span class="version-badge">
                        <i class="feather icon-tag mr-1"></i>{{ __('Current Version') }}: {{ $currentVersion }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills nav-pills-custom mb-4" id="smartUpdaterTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab">
                <i class="feather icon-upload mr-1"></i>{{ __('Upload Update') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="backups-tab" data-toggle="tab" href="#backups" role="tab">
                <i class="feather icon-archive mr-1"></i>{{ __('Backups') }}
                <span class="badge badge-secondary ml-1">{{ count($backups) }}</span>
            </a>
        </li>
    </ul>

    <div class="tab-content" id="smartUpdaterTabsContent">
        <div class="tab-pane fade show active" id="upload" role="tabpanel">
            <div class="alert alert-custom alert-warning-custom mb-4">
                <i class="feather icon-alert-triangle mr-2"></i>
                <strong>{{ __('Important') }}:</strong> 
                {{ __('This tool will only install NEW modules from the update. Your existing code and customizations will NOT be modified.') }}
            </div>

            <div class="card mb-4" id="uploadCard">
                <div class="card-body">
                    <form id="analyzeForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="upload-zone" id="uploadZone">
                                    <input type="file" name="attachment" id="updateFile" accept=".zip" style="display: none;">
                                    <i class="feather icon-upload-cloud"></i>
                                    <h5>{{ __('Drop your update file here') }}</h5>
                                    <p class="text-muted">{{ __('or click to browse (ZIP files only)') }}</p>
                                    <p class="text-muted small" id="selectedFileName"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="purchaseCode">{{ __('Purchase Code') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="purchaseCode" id="purchaseCode" placeholder="{{ __('Enter your Envato purchase code') }}" required>
                                    <small class="text-muted">{{ __('Required to verify your license') }}</small>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-gradient btn-block" id="analyzeBtn">
                                        <i class="feather icon-search mr-1"></i>{{ __('Analyze Update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="analysis-result" id="analysisResult">
                <div class="alert alert-custom alert-info-custom mb-4" id="versionInfo">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="feather icon-info mr-2"></i>
                            <strong>{{ __('Update Version') }}:</strong> <span id="updateVersion">-</span>
                        </div>
                        <div>
                            <span class="text-muted">{{ __('Current') }}: {{ $currentVersion }}</span>
                        </div>
                    </div>
                </div>

                <div class="card mb-4" id="newModulesCard">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="feather icon-package text-success mr-2"></i>
                            {{ __('New Modules Available') }}
                            <span class="badge badge-success ml-2" id="newModulesCount">0</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="select-all-container d-flex justify-content-between align-items-center" id="selectAllNewContainer" style="display: none !important;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectAllNew">
                                <label class="custom-control-label" for="selectAllNew">{{ __('Select All New Modules') }}</label>
                            </div>
                            <span class="text-muted" id="selectedNewCount">0 {{ __('selected') }}</span>
                        </div>
                        <div id="newModulesList">
                            <div class="empty-state">
                                <i class="feather icon-inbox"></i>
                                <p>{{ __('No new modules found in this update') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4" id="updatedModulesCard" style="display: none;">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="feather icon-refresh-cw text-warning mr-2"></i>
                            {{ __('Updated Modules') }}
                            <span class="badge badge-warning ml-2" id="updatedModulesCount">0</span>
                        </h5>
                        <small class="text-danger">{{ __('Warning: Installing these may overwrite your customizations') }}</small>
                    </div>
                    <div class="card-body">
                        <div id="updatedModulesList"></div>
                    </div>
                </div>

                <div class="card mb-4" id="newConfigsCard" style="display: none;">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="feather icon-settings text-info mr-2"></i>
                            {{ __('New Configuration Files') }}
                            <span class="badge badge-info ml-2" id="newConfigsCount">0</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="newConfigsList"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="createBackup" checked>
                                    <label class="custom-control-label" for="createBackup">
                                        <strong>{{ __('Create backup before installation') }}</strong>
                                        <br><small class="text-muted">{{ __('Recommended - allows you to restore if something goes wrong') }}</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-outline-gradient mr-2" id="cancelBtn">
                                    <i class="feather icon-x mr-1"></i>{{ __('Cancel') }}
                                </button>
                                <button type="button" class="btn btn-gradient" id="installBtn" disabled>
                                    <i class="feather icon-download mr-1"></i>{{ __('Install Selected Modules') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="backups" role="tabpanel">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="feather icon-archive mr-2"></i>{{ __('Available Backups') }}
                    </h5>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="refreshBackups">
                        <i class="feather icon-refresh-cw"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div id="backupsList">
                        @if(count($backups) > 0)
                            @foreach($backups as $backup)
                                <div class="backup-card" data-backup-id="{{ $backup['id'] }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="backup-date">
                                                <i class="feather icon-clock mr-1"></i>
                                                {{ $backup['created_at'] }}
                                            </div>
                                            <div class="backup-modules mt-1">
                                                <i class="feather icon-package mr-1"></i>
                                                {{ __('Modules') }}: {{ implode(', ', $backup['modules']) ?: __('None') }}
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-success restore-backup-btn" data-backup-id="{{ $backup['id'] }}">
                                                <i class="feather icon-rotate-ccw"></i> {{ __('Restore') }}
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-backup-btn" data-backup-id="{{ $backup['id'] }}">
                                                <i class="feather icon-trash-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="feather icon-archive"></i>
                                <p>{{ __('No backups available') }}</p>
                                <small class="text-muted">{{ __('Backups will be created automatically when you install modules') }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    const analyzeUrl = "{{ route('smart-updater.analyze') }}";
    const installUrl = "{{ route('smart-updater.install') }}";
    const restoreUrl = "{{ route('smart-updater.restore') }}";
    const deleteBackupUrl = "{{ route('smart-updater.delete-backup') }}";
    const csrfToken = "{{ csrf_token() }}";

    let selectedModules = [];
    let selectedConfigs = [];

    const uploadZone = $('#uploadZone');
    const fileInput = $('#updateFile');

    uploadZone.on('click', function() { fileInput.click(); });
    uploadZone.on('dragover', function(e) { e.preventDefault(); $(this).addClass('dragover'); });
    uploadZone.on('dragleave', function() { $(this).removeClass('dragover'); });
    uploadZone.on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            fileInput[0].files = files;
            $('#selectedFileName').html('<i class="feather icon-file mr-1"></i>' + files[0].name);
        }
    });

    fileInput.on('change', function() {
        if (this.files.length > 0) {
            $('#selectedFileName').html('<i class="feather icon-file mr-1"></i>' + this.files[0].name);
        }
    });

    function showLoading(text) {
        $('#loadingText').text(text || '{{ __("Processing...") }}');
        $('#loadingOverlay').addClass('show');
    }

    function hideLoading() { $('#loadingOverlay').removeClass('show'); }

    $('#analyzeForm').on('submit', function(e) {
        e.preventDefault();
        if (!fileInput[0].files.length) { toastr.error('{{ __("Please select an update file") }}'); return; }
        if (!$('#purchaseCode').val()) { toastr.error('{{ __("Please enter your purchase code") }}'); return; }

        const formData = new FormData(this);
        showLoading('{{ __("Analyzing update file...") }}');

        $.ajax({
            url: analyzeUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': csrfToken },
            success: function(response) {
                hideLoading();
                if (response.success) {
                    displayAnalysisResult(response.data);
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                hideLoading();
                toastr.error(xhr.responseJSON?.message || '{{ __("An error occurred") }}');
            }
        });
    });

    function displayAnalysisResult(data) {
        $('#analysisResult').addClass('show');
        $('#uploadCard').hide();
        $('#updateVersion').text(data.update_version || '-');

        const newModules = data.new_modules || [];
        $('#newModulesCount').text(newModules.length);

        if (newModules.length > 0) {
            $('#selectAllNewContainer').show().css('display', 'flex');
            let html = '';
            newModules.forEach(function(module, index) {
                html += createModuleCard(module, 'new', index);
            });
            $('#newModulesList').html(html);
        }

        const updatedModules = data.updated_modules || [];
        $('#updatedModulesCount').text(updatedModules.length);
        if (updatedModules.length > 0) {
            $('#updatedModulesCard').show();
            let html = '';
            updatedModules.forEach(function(module, index) {
                html += createModuleCard(module, 'update', index);
            });
            $('#updatedModulesList').html(html);
        }

        const newConfigs = data.new_configs || [];
        $('#newConfigsCount').text(newConfigs.length);
        if (newConfigs.length > 0) {
            $('#newConfigsCard').show();
            let html = '';
            newConfigs.forEach(function(config, index) {
                html += '<div class="custom-control custom-checkbox mb-2"><input type="checkbox" class="custom-control-input config-checkbox" id="config_' + index + '" value="' + config.name + '"><label class="custom-control-label" for="config_' + index + '"><i class="feather icon-file-text mr-1"></i>' + config.name + '</label></div>';
            });
            $('#newConfigsList').html(html);
        }

        updateInstallButton();
    }

    function createModuleCard(module, type, index) {
        const badgeClass = type === 'new' ? 'badge-new' : 'badge-update';
        const badgeText = type === 'new' ? '{{ __("NEW") }}' : '{{ __("UPDATE") }}';
        const checkboxClass = type === 'new' ? 'new-module-checkbox' : 'update-module-checkbox';
        let versionInfo = type === 'update' ? '<span class="text-muted ml-2">' + module.current_version + ' → ' + module.new_version + '</span>' : '';

        return '<div class="module-card" data-module="' + module.folder_name + '">' +
            '<div class="d-flex align-items-start">' +
            '<div class="custom-control custom-checkbox mr-3 mt-2"><input type="checkbox" class="custom-control-input ' + checkboxClass + '" id="' + type + '_module_' + index + '" value="' + module.folder_name + '"><label class="custom-control-label" for="' + type + '_module_' + index + '"></label></div>' +
            '<div class="module-icon mr-3"><i class="feather icon-box"></i></div>' +
            '<div class="module-info flex-grow-1">' +
            '<div class="d-flex align-items-center mb-1"><h5>' + (module.display_name || module.name || module.folder_name) + '</h5><span class="' + badgeClass + ' ml-2">' + badgeText + '</span>' + versionInfo + '</div>' +
            '<p>' + (module.description || '{{ __("No description available") }}') + '</p>' +
            '<div class="module-meta mt-2"><span><i class="feather icon-folder mr-1"></i>' + module.folder_name + '</span><span><i class="feather icon-file mr-1"></i>' + (module.files_count || 0) + ' {{ __("files") }}</span><span><i class="feather icon-hard-drive mr-1"></i>' + (module.size || '-') + '</span></div>' +
            '</div></div></div>';
    }

    $(document).on('change', '.new-module-checkbox, .update-module-checkbox', function() {
        const moduleName = $(this).val();
        const moduleCard = $(this).closest('.module-card');

        if ($(this).is(':checked')) {
            if (!selectedModules.includes(moduleName)) selectedModules.push(moduleName);
            moduleCard.addClass('selected');
        } else {
            selectedModules = selectedModules.filter(m => m !== moduleName);
            moduleCard.removeClass('selected');
        }

        updateSelectAllCheckbox();
        updateInstallButton();
    });

    $(document).on('change', '.config-checkbox', function() {
        const configName = $(this).val();
        if ($(this).is(':checked')) {
            if (!selectedConfigs.includes(configName)) selectedConfigs.push(configName);
        } else {
            selectedConfigs = selectedConfigs.filter(c => c !== configName);
        }
    });

    $('#selectAllNew').on('change', function() {
        $('.new-module-checkbox').prop('checked', $(this).is(':checked')).trigger('change');
    });

    function updateSelectAllCheckbox() {
        const totalNew = $('.new-module-checkbox').length;
        const checkedNew = $('.new-module-checkbox:checked').length;
        $('#selectAllNew').prop('checked', totalNew > 0 && totalNew === checkedNew);
        $('#selectedNewCount').text(checkedNew + ' {{ __("selected") }}');
    }

    function updateInstallButton() {
        $('#installBtn').prop('disabled', selectedModules.length === 0);
        $('#installBtn').html('<i class="feather icon-download mr-1"></i>{{ __("Install Selected") }} (' + selectedModules.length + ')');
    }

    $('#cancelBtn').on('click', function() {
        if (confirm('{{ __("Are you sure you want to cancel?") }}')) {
            selectedModules = [];
            selectedConfigs = [];
            $('#analysisResult').removeClass('show');
            $('#uploadCard').show();
            $('#analyzeForm')[0].reset();
            $('#selectedFileName').text('');
            $('#updatedModulesCard').hide();
            $('#newConfigsCard').hide();
            updateInstallButton();
        }
    });

    $('#installBtn').on('click', function() {
        if (selectedModules.length === 0) { toastr.warning('{{ __("Please select at least one module") }}'); return; }
        if (!confirm('{{ __("Install selected modules?") }}')) return;

        showLoading('{{ __("Installing modules...") }}');

        $.ajax({
            url: installUrl,
            type: 'POST',
            data: JSON.stringify({ modules: selectedModules, config_files: selectedConfigs, create_backup: $('#createBackup').is(':checked') }),
            contentType: 'application/json',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            success: function(response) {
                hideLoading();
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        if (confirm('{{ __("Modules installed. Reload page?") }}')) window.location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                hideLoading();
                toastr.error(xhr.responseJSON?.message || '{{ __("Installation failed") }}');
            }
        });
    });

    $(document).on('click', '.restore-backup-btn', function() {
        const backupId = $(this).data('backup-id');
        if (!confirm('{{ __("Restore this backup?") }}')) return;

        showLoading('{{ __("Restoring backup...") }}');

        $.ajax({
            url: restoreUrl,
            type: 'POST',
            data: JSON.stringify({ backup_id: backupId }),
            contentType: 'application/json',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            success: function(response) {
                hideLoading();
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function() { window.location.reload(); }, 2000);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                hideLoading();
                toastr.error(xhr.responseJSON?.message || '{{ __("Restore failed") }}');
            }
        });
    });

    $(document).on('click', '.delete-backup-btn', function() {
        const backupId = $(this).data('backup-id');
        const card = $(this).closest('.backup-card');
        if (!confirm('{{ __("Delete this backup?") }}')) return;

        $.ajax({
            url: deleteBackupUrl,
            type: 'POST',
            data: JSON.stringify({ backup_id: backupId }),
            contentType: 'application/json',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            success: function(response) {
                if (response.success) {
                    card.fadeOut(300, function() { $(this).remove(); });
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || '{{ __("Delete failed") }}');
            }
        });
    });

    $('#refreshBackups').on('click', function() { window.location.reload(); });
});
</script>
@endsection
