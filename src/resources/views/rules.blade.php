@extends('web::layouts.grids.12')

@section('title', trans('rules::seat.all_rules'))

@section('full')
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('rules::seat.corp_rules') }}
                @if($rules['alliance_lang'] !== null)
                    -
                @endif
                @foreach($rules['corporation_langs'] as $lang)
                    @if($rules['corporation_lang'] !== $lang['short'])
                        <a href="{{ route('rules.show_lang', ['lang' => $lang['short']]) }}">{{$lang['full']}}</a>
                    @else
                        <strong>({{trans('rules::seat.actual')}}){{$lang['full']}}</strong>
                    @endif

                    @if(!$loop->last)
                        |
                    @endif
                @endforeach</h3>
        </div>
        <div class="panel-body">
            @if($rules['corporation'] !== null)
                {!! $rules['corporation']->content !!}
            @else
            {{trans('rules::seat.none')}}
            @endif
        </div>
    </div>
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('rules::seat.alliance_rules') }}
                @if($rules['alliance_lang'] !== null)
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
        <div class="panel-body">
            @if($rules['alliance'] !== null)
                {!! $rules['alliance']->content !!}
            @else
                {{trans('rules::seat.none')}}
            @endif
        </div>
    </div>
@stop
