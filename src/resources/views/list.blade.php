@extends('web::layouts.grids.12')

@section('title', trans('rules::seat.manage'))
@section('page_header', trans('rules::seat.manage'))

@section('full')

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="card-title">{{ trans('rules::seat.manage') }}</h3>
        </div>
        <div class="panel-body">
            <a href="{{ route('rules.create') }}" class="btn btn-default mb-2">
                <i class="fas fa-plus"></i>
                {{trans('rules::seat.create')}}
            </a><br />
            <div class="tab-content">

                <table id="rules-table" class="table compact table-condensed table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>{{ trans('rules::seat.corp_or_alli') }}</th>
                        <th>{{ trans('rules::seat.language') }}</th>
                        <th>{{ trans('web::seat.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rules as $rule)
                        <tr>
                            <td>
                                @if($rule->object_type === "alliance")
                                    {{ $rule->getObject()->name }}
                                @else
                                    @include('web::partials.corporation', ['corporation' => $rule->getObject()])
                                @endif
                            </td>
                            <td>{{$rule->language}}</td>
                            <td>@include('rules::partials.action', ['rule' => $rule])</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>


            <a href="{{ route('rules.create') }}" class="btn btn-default">
                <i class="fas fa-plus"></i>
                {{trans('rules::seat.create')}}
            </a>
        </div>
    </div>

@stop

@push('javascript')

@endpush
