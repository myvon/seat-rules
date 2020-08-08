@extends('web::layouts.grids.12')

@section('title', trans('rules::seat.manage'))
@section('page_header', trans('rules::seat.manage'))

@section('full')

    <div class="card card-default">

        <div class="card-header">
            <h3 class="card-title">{{ trans('rules::seat.manage') }}</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('rules.create') }}" class="btn btn-default mb-2">
                <i class="fas fa-plus"></i>
                {{trans('rules::seat.create')}}
            </a><br />
            {{ $dataTable->table() }}

            <a href="{{ route('rules.create') }}" class="btn btn-default">
                <i class="fas fa-plus"></i>
                {{trans('rules::seat.create')}}
            </a>
        </div>
    </div>

@stop

@push('javascript')

    {{ $dataTable->scripts() }}

    @include('web::includes.javascript.id-to-name')

@endpush
