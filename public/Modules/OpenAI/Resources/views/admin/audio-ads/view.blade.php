@extends('admin.layouts.app')
@section('page_title', __('View :x', ['x' => __('Audio Ad')]))
@section('content')
    <div class="col-sm-12" id="page-container" data-val="edit">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('admin.features.audio-ads.lists') }}">{{ __('Audio Ads') }}</a> >> {{ __('View') }}</h5>
            </div>
            <div class="card-body px-3" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home"
                                role="tab" aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('Audio Ad')]) }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-bold text-uppercase" id="script-tab" data-bs-toggle="tab" href="#script"
                                role="tab" aria-controls="script"
                                aria-selected="false">{{ __('Script') }}</a>
                        </li>
                    </ul>
                    <div class="col-sm-12 tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Title') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $audioAd->title }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Ad Text') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $audioAd->ad_text }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Product Type') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ ucfirst($audioAd->product_type ?? 'N/A') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Ad Style') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ ucfirst(str_replace('_', ' ', $audioAd->ad_style ?? 'N/A')) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Target Platform') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ ucfirst($audioAd->target_platform ?? 'N/A') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Target Duration') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $audioAd->target_duration ?? 0 }} {{ __('seconds') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Actual Duration') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $audioAd->actual_duration ?? 0 }} {{ __('seconds') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Voice') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $audioAd->voice_name ?? $audioAd->voice_id ?? 'N/A' }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Status') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'processing' => 'info',
                                                    'completed' => 'success',
                                                    'failed' => 'danger',
                                                ];
                                                $color = $statusColors[$audioAd->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge badge-{{ $color }}">{{ ucfirst($audioAd->status) }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Tier') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <span class="badge badge-{{ $audioAd->tier == 'premium' ? 'primary' : 'secondary' }}">{{ ucfirst($audioAd->tier ?? 'free') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Provider') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ ucfirst($audioAd->provider ?? 'N/A') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('User') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <a href="{{ route('users.edit', ['id' => $audioAd->user_id]) }}">{{ optional($audioAd->user)->name }}</a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Created At') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ timeZoneFormatDate($audioAd->created_at) }}
                                        </div>
                                    </div>

                                    @if($audioAd->audio_path)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Audio (Final)') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <audio controls src="{{ asset($audioAd->audio_path) }}"></audio>
                                        </div>
                                    </div>
                                    @endif

                                    @if($audioAd->audio_voice_only)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Audio (Voice Only)') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <audio controls src="{{ asset($audioAd->audio_voice_only) }}"></audio>
                                        </div>
                                    </div>
                                    @endif

                                    @if($audioAd->error_message)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold text-danger">{{ __('Error') }}</label>
                                        <div class="col-sm-9 mt-2 text-danger">
                                            {{ $audioAd->error_message }}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="script" role="tabpanel" aria-labelledby="script-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="fw-bold mb-2">{{ __('Generated Script') }}</label>
                                        <div class="p-3 bg-light rounded" style="white-space: pre-wrap; max-height: 500px; overflow-y: auto;">{{ $audioAd->generated_script ?? __('No script available') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4 pb-2">
                            <a href="{{ route('admin.features.audio-ads.lists') }}"
                                class="btn all-cancel-btn custom-btn-cancel">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
