@extends('admin.layouts.app')
@section('page_title', __('View :x', ['x' => __('Podcast')]))
@section('content')
    <div class="col-sm-12" id="page-container" data-val="edit">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('admin.features.podcast.lists') }}">{{ __('Podcasts') }}</a> >> {{ __('View') }}</h5>
            </div>
            <div class="card-body px-3" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home"
                                role="tab" aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('Podcast')]) }}</a>
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
                                            {{ $podcast->title }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Topic') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $podcast->topic }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Host A Name') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $podcast->host_a_name ?? 'N/A' }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Host B Name') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $podcast->host_b_name ?? 'N/A' }}
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
                                                $color = $statusColors[$podcast->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge badge-{{ $color }}">{{ ucfirst($podcast->status) }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Tier') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <span class="badge badge-{{ $podcast->tier == 'premium' ? 'primary' : 'secondary' }}">{{ ucfirst($podcast->tier) }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Provider') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ ucfirst($podcast->provider ?? 'N/A') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Word Count') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ number_format($podcast->word_count ?? 0) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Estimated Duration') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $podcast->estimated_duration ?? 0 }} {{ __('minutes') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('User') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <a href="{{ route('users.edit', ['id' => $podcast->user_id]) }}">{{ optional($podcast->user)->name }}</a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Created At') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ timeZoneFormatDate($podcast->created_at) }}
                                        </div>
                                    </div>

                                    @if($podcast->audio_path)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Audio') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <audio controls src="{{ asset($podcast->audio_path) }}"></audio>
                                        </div>
                                    </div>
                                    @endif

                                    @if($podcast->error_message)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold text-danger">{{ __('Error') }}</label>
                                        <div class="col-sm-9 mt-2 text-danger">
                                            {{ $podcast->error_message }}
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
                                        <label class="fw-bold mb-2">{{ __('Podcast Script') }}</label>
                                        <div class="p-3 bg-light rounded" style="white-space: pre-wrap; max-height: 500px; overflow-y: auto;">{{ $podcast->script ?? __('No script available') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4 pb-2">
                            <a href="{{ route('admin.features.podcast.lists') }}"
                                class="btn all-cancel-btn custom-btn-cancel">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
