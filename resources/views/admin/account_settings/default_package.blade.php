@extends('admin.layouts.app')
@section('page_title', __('Account Settings'))
@section('css')

@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="account-settings-container">
        <div class="card">
            <div class="card-body row">
                <div class="col-lg-3 col-12 z-index-10 pe-0 ps-0 ps-md-3">
                    @include('admin.layouts.includes.account_settings_menu')
                </div>
                <div class="col-lg-9 col-12 ps-0">
                    <div class="card card-info shadow-none mb-0">
                        <div class="card-header p-t-20 border-bottom">
                            <h5>{{ __('Default Package') }}</h5>
                        </div>
                        <div class="card-block table-border-style">
                            <form action="{{ route('account.setting.defaultPackageStore') }}" method="post" class="form-horizontal" id="preference_form">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-4 control-label" for="is_default_package">{{ __('Default package for customer') }}</label>
                                    <div class="col-6">
                                        <div class="switch switch-bg d-inline m-r-10">
                                            <input class="customer-signup" type="checkbox" value="{{ preference('is_default_package') ? preference('is_default_package') : 0 }}" name="is_default_package" id="is_default_package" {{ preference('is_default_package') == 1 ? 'checked' : '' }}>
                                            <label for="is_default_package" class="cr"></label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="default" name="code">
                                <input type="hidden" value="0" name="price">
                                <input type="hidden" value="0" name="sort_order">
                                <input type="hidden" value="Active" name="status">
                                <input type="hidden" value="default" name="type">
                                <div class="form-group row signup_email_div"{{ preference('is_default_package') == 1 ? '' : 'hidden'}}>
                                    <div class="row">
                                        <label for="name" class="col-4 control-label require">{{ __('Name') }}</label>
                                        <div class="col-sm-6 flex-wrap">
                                            <input type="text"
                                            @if (preference('is_default_package') == 1)
                                            required
                                            @endif
                                            name="name"
                                            placeholder="{{ __('Name') }}"
                                            id="name"
                                            class="form-control"
                                            value="{{ $defaultPackage ? $defaultPackage->name : '' }}">
                                        </div>
                                    </div>
                                    @foreach($features as $featureKey => $feature)
                                        @if(isset($feature['type']) && $feature['type'] == 'number' && (!isset($feature['is_visible']) || $feature['is_visible'] == 1) && $featureKey != 'image-resolution')
                                            <div class="mt-20p row">
                                                <label for="features_{{ $featureKey }}" class="col-4 control-label require">{{ __($feature['title'] ?? ucfirst(str_replace(['-', '_'], ' ', $featureKey))) }}</label>
                                                <div class="col-sm-6 flex-wrap">
                                                    <input type="text"
                                                    @if (preference('is_default_package') == 1)
                                                    required
                                                    @endif
                                                    name="features[{{ $featureKey }}]" 
                                                    placeholder="{{ __($feature['title'] ?? ucfirst(str_replace(['-', '_'], ' ', $featureKey))) }}"
                                                    id="features_{{ $featureKey }}"
                                                    class="form-control int-number"
                                                    value="{{ $defaultPackage && isset($defaultPackage->features[$featureKey]) ? $defaultPackage->features[$featureKey] : ($feature['value'] ?? '') }}">
                                                    <label class="mt-1">
                                                        <span class="badge badge-warning me-2">{{ __('Note') }}</span>{{ __('-1 for unlimited') }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
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
    <script src="{{ asset('public/datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/settings.min.js') }}"></script>
@endsection
