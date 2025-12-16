@extends('admin.layouts.app')
@section('page_title', __('View :x', ['x' => __('Conversation')]))
@section('content')
    <div class="col-sm-12" id="page-container" data-val="edit">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('admin.features.voxchat.lists') }}">{{ __('VoxChat Conversations') }}</a> >> {{ __('View') }}</h5>
            </div>
            <div class="card-body px-3" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-bold active text-uppercase" id="info-tab" data-bs-toggle="tab" href="#info"
                                role="tab" aria-controls="info"
                                aria-selected="true">{{ __(':x Information', ['x' => __('Conversation')]) }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-bold text-uppercase" id="messages-tab" data-bs-toggle="tab" href="#messages"
                                role="tab" aria-controls="messages"
                                aria-selected="false">{{ __('Messages') }} ({{ $conversation->messages->count() }})</a>
                        </li>
                    </ul>
                    <div class="col-sm-12 tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Title') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $conversation->title ?? $conversation->display_title ?? __('Conversation #') . $conversation->id }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('AI Model') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <span class="badge badge-primary">{{ $conversation->ai_model ?? 'gpt-4o' }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Voice Gender') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ ucfirst($conversation->voice_gender ?? 'N/A') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Total Messages') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ $conversation->messages->count() }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Total Tokens') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ number_format($conversation->total_tokens ?? 0) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('User') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            <a href="{{ route('users.edit', ['id' => $conversation->user_id]) }}">{{ optional($conversation->user)->name }}</a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Created At') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ timeZoneFormatDate($conversation->created_at) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pe-0 fw-bold">{{ __('Last Updated') }}</label>
                                        <div class="col-sm-9 mt-2">
                                            {{ timeZoneFormatDate($conversation->updated_at) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="conversation-messages p-3" style="max-height: 600px; overflow-y: auto;">
                                        @forelse($conversation->messages as $message)
                                            <div class="message-item mb-3 p-3 rounded {{ $message->role === 'user' ? 'bg-light' : 'bg-primary-light' }}" style="{{ $message->role === 'assistant' ? 'background-color: #e3f2fd;' : '' }}">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <strong class="{{ $message->role === 'user' ? 'text-primary' : 'text-success' }}">
                                                        @if($message->role === 'user')
                                                            <i class="feather icon-user me-1"></i> {{ __('User') }}
                                                        @elseif($message->role === 'assistant')
                                                            <i class="feather icon-cpu me-1"></i> {{ __('AI Assistant') }}
                                                        @else
                                                            <i class="feather icon-settings me-1"></i> {{ __('System') }}
                                                        @endif
                                                    </strong>
                                                    <small class="text-muted">
                                                        {{ timeZoneFormatDate($message->created_at) }}
                                                        @if($message->tokens_used)
                                                            | {{ number_format($message->tokens_used) }} {{ __('tokens') }}
                                                        @endif
                                                    </small>
                                                </div>
                                                <div class="message-content">
                                                    @if($message->content_type === 'audio' && $message->media_path)
                                                        <div class="mb-2">
                                                            <audio controls src="{{ asset($message->media_path) }}" class="w-100"></audio>
                                                        </div>
                                                    @endif
                                                    @if($message->content_type === 'image' && $message->media_path)
                                                        <div class="mb-2">
                                                            <img src="{{ asset($message->media_path) }}" class="img-fluid rounded" style="max-width: 300px;" alt="Image">
                                                        </div>
                                                    @endif
                                                    <div style="white-space: pre-wrap;">{{ $message->content }}</div>
                                                    @if($message->audio_response_path)
                                                        <div class="mt-2">
                                                            <small class="text-muted">{{ __('Audio Response') }}:</small>
                                                            <audio controls src="{{ asset($message->audio_response_path) }}" class="w-100"></audio>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-muted py-4">
                                                {{ __('No messages in this conversation') }}
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4 pb-2">
                            <a href="{{ route('admin.features.voxchat.lists') }}"
                                class="btn all-cancel-btn custom-btn-cancel">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
