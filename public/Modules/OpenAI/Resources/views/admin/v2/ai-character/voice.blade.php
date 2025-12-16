@extends('admin.layouts.app')
@section('page_title', __('Avatar Voices'))

@section('css')
@endsection

@section('content')
<!-- Main content -->
<div class="col-sm-12 list-container" id="avatar-voice-list-container">
    <div class="card">
        <div class="card-header bb-none pb-0 mb-2">
            <h5>{{ __('Avatar Voice Lists') }}</h5>
            <div class="card-header-right my-2 mx-md-0 mx-sm-4">
                <x-backend.button.sync-button label="{{ __('Sync') }}" iconClass="fas fa-sync" class="me-1" />
                <x-backend.button.filter class="me-0" />
            </div>
        </div>
        <x-backend.datatable.filter-panel class="mx-1">
            <div class="col-md-6">
                <x-backend.datatable.input-search />
            </div>
            <div class="col-md-3">
                <select class="select2-hide-search filter" name="user_id">
                    <option value="">{{ __('All Users') }}</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="select2-hide-search filter" name="gender">
                    <option value="">{{ __('Gender') }}</option>
                    <option value="male"> {{ __('Male') }}</option>
                    <option value="female">{{ __('Female') }}</option>
                </select>
            </div>
        </x-backend.datatable.filter-panel>
        <x-backend.datatable.table-wrapper class="user-list-wallet user-list-processing-message"
            data-namespace="\Modules\OpenAI\Entities\Voice" data-column="id">
            @include('admin.layouts.includes.yajra-data-table')
        </x-backend.datatable.table-wrapper>

        <div class="modal fade modal-animate anim-blur" id="animateModal" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white">{{ __('Sync :x', ['x' => __('Voices')]) }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @if ( count($providers) != 0 )
                            <form id="sync-data-form">
                                <input type="hidden" name="type" id="type" value="voices">

                                <div class="form-group">
                                    <label for="feature" class="form-label">{{ __('Choose Feature') }}:</label>
                                    <select name="feature" class="form-control" id="feature">
                                        <option selected>{{ __('Select One') }}</option>
                                        @foreach ($providers as $key => $provider)
                                            <option value="{{ $key }}">{{ ucFirst($key) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="provider" class="form-label">{{ __('Choose Provider') }}:</label>
                                    <select name="provider" class="form-control" id="provider">
                                        <option selected>{{ __('Select One') }}</option>
                                        @foreach ($providers as  $key => $provider)
                                            @foreach ($provider as $value)
                                                <option id="{{ $key . '_' . $value }}" value="{{ $value }}">{{ ucFirst($value) }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </form>

                            <div class="py-1" id="note_txt_1">
                                <div class="d-flex mt-1 mb-3">
                                    <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                    <ul class="list-unstyled ml-3">
                                        <li class="justify-content-center">{{ __('Please be aware that syncing data will update your existing data with the most recent versions. This action cannot be undone. Are you sure you want to continue?') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else 
                            <p>{{ __('Please activate at least one provider to continue syncing.') }}</p>
                        @endif
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary animateModal-close" data-bs-dismiss="modal">{{ __('Close') }}</button> 
                        <button type="button" id="sync-data" class="btn btn-primary shadow-2 {{ count($providers) == 0 ? 'disabled' : '' }}">{{ __('Sync Now') }}</button>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.includes.delete-modal')
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    'use strict';
    var pdf = "0";
    var csv = "0";
    var listContainer = "avatar-voice-list-container";
    var endRoute = "/ai-character/voices/";
    var route = "/ai-character";
</script>
<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/document-list.min.js') }}"></script>

@endsection
