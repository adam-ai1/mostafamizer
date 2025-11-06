@extends('admin.layouts.app')
@section('page_title', __('Maintenance Mode'))
@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="maintenance-container">
        <div class="card">
            <div class="card-body row">
                <div class="col-lg-3 col-12 z-index-10 pe-0 ps-0 ps-md-3">
                    @include('admin.layouts.includes.general_settings_menu')
                </div>
                <div class="col-lg-9 col-12 ps-0">
                    <div class="card card-info shadow-none mb-0">
                        @if(session('errorMgs'))
                            <div class="alert alert-warning fade in alert-dismissable">
                                <strong>{{ __('Warning') }}!</strong> {{ session('errorMgs') }}. <a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a>
                            </div>
                        @endif
                        <span id="smtp_head">
                            <div class="card-header p-t-20 border-bottom">
                                <h5>{{ __('System Configuration') }}</h5>
                            </div>
                        </span>
                        
                        <div class="card-body p-l-15">
                            <form action="{{ route('systemConfiguration.settings') }}" method="post" class="form-horizontal">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                <div class="form-group row">
                                    <label for="maintainance-mode" class="col-sm-3 control-label require">{{ __('Maintenance Mode') }}</label>
                                    <div class="col-sm-8">
                                        <select class="select2-hide-search form-control" name="maintenance" id="maintainance-mode">
                                            <option value ='true' {{ app()->isDownForMaintenance() ? 'selected' : "" }} >{{ __('Enable') }} </option>
                                            <option value ='false' {{ !app()->isDownForMaintenance() ? 'selected' : "" }} >{{ __('Disable') }} </option>
                                        </select>
                                        <label for="maintainance-mode" generated="true" class="error"></label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group row" id="bypass-url">
                                    <label class="col-sm-3 control-label">{{ __('Bypass URL') }}</label>
                                    <div class="col-sm-8">
                                        @if(app()->isDownForMaintenance())
                                            <label><a href="{{ url('/', $secret) }}">{{ url('/', $secret) }}</a></label>
                                        @endif
                                    </div>
                                </div>
                                    
                                <div class="form-group row">
                                    <label for="system-environment" class="col-sm-3 control-label require">{{ __('System Environment') }}</label>
                                    <div class="col-sm-8">
                                        <select class="select2-hide-search form-control" name="system_environment" id="system-environment">
                                            <option value ='local' {{ config('app.env') == 'local' ? 'selected' : '' }}>{{ __('Local') }} </option>
                                            <option value ='production' {{ config('app.env') == 'production' ? 'selected' : '' }}>{{ __('Production') }} </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="debug_mode" class="col-sm-3 text-left control-label">{{ __('Debug Mode') }}</label>
                                    <div class="col-sm-8 d-flex">
                                        <input type="hidden" name="debug_mode" value="0">
                                        <div class="switch switch-bg d-inline m-r-10">
                                            <input class="is_default" name="debug_mode"  {{ config('app.debug') ? 'checked' : '' }} value="1" type="checkbox" id="system-debug">
                                            <label for="system-debug" class="cr"></label>
                                        </div>
                                        <div class="mt-2">
                                            <span class="badge badge-danger mt-1">{{ __('Note') }}!</span>
                                            <small
                                                class="mt-1 ml-2">{{ __('System debug mode should be disabled in production.') }}</small>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="card-footer p-0">
                                    <div class="form-group row">
                                        <label for="btn_save" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn form-submit custom-btn-submit float-right" id="footer-btn">
                                                {{ __('Save') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/settings.min.js') }}"></script>
@endsection
