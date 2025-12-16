@extends('admin.layouts.app')
@section('page_title', __('Podcasts'))

@section('content')
<!-- Main content -->
<div class="col-sm-12 list-container" id="podcast-list-container">
    <div class="card">
        <div class="card-header bb-none pb-0 mb-2">
            <h5>{{ __('Podcasts') }}</h5>
            <div class="card-header-right my-2 mx-md-0 mx-sm-4">
                <x-backend.button.batch-delete class="me-1" />
                <x-backend.button.filter class="me-0" />
            </div>
        </div>
        <x-backend.datatable.filter-panel class="mx-1">
            <div class="col-md-3">
                <x-backend.datatable.input-search />
            </div>
            <div class="col-md-3">
                <select class="select2 filter" name="user_id">
                    <option value="">{{ __('All Users') }}</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="select2 filter" name="status">
                    <option value="">{{ __('All Statuses') }}</option>
                    @foreach($statuses as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="select2 filter" name="tier">
                    <option value="">{{ __('All Tiers') }}</option>
                    @foreach($tiers as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </x-backend.datatable.filter-panel>
        <x-backend.datatable.table-wrapper class="user-list-wallet user-list-processing-message need-batch-operation"
            data-namespace="\Modules\OpenAI\Entities\Podcast" data-column="id">
            @include('admin.layouts.includes.yajra-data-table')
        </x-backend.datatable.table-wrapper>
        @include('admin.layouts.includes.delete-modal')
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    'use strict';
    var listContainer = "podcast-list-container";
</script>
<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/document-list.min.js') }}"></script>
@endsection
