@extends('web::layouts.grids.12')

@section('title', trans('rules::seat.all_rules'))

@section('full')
    <div class="card card-default">

        <div class="card-header">
            <h3 class="card-title">{{ trans('rules::seat.corp_rules') }}@if($rules['corporation_lang'] !== null) - {{$rules['corporation_lang']}}@endif</h3>
        </div>
        <div class="card-body">
            @if($rules['corporation'] !== null)
                {!! $rules['corporation']->content !!}
            @else
            {{trans('rules::seat.none')}}
            @endif
        </div>
    </div>
    <div class="card card-default">

        <div class="card-header">
            <h3 class="card-title">{{ trans('rules::seat.alliance_rules') }}
                @if($rules['alliance_langs'] !== null)
                    -
                @endif
                @foreach($rules['alliance_langs'] as $lang)
                    @if($rules['alliance_lang'] !== $lang['short'])
                        <a href="{{ route('rules.show_lang', ['lang' => $lang['short']]) }}">{{$lang['full']}}</a>
                    @else
                        <strong>({{trans('rules::seat.actual')}}){{$lang['full']}}</strong>
                    @endif

                    @if(!$loop->last)
                        |
                    @endif
                @endforeach
            </h3>
        </div>
        <div class="card-body">
            @if($rules['alliance'] !== null)
                {!! $rules['alliance']->content !!}
            @else
                {{trans('rules::seat.none')}}
            @endif
        </div>
    </div>
@stop
