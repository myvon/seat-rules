@extends('web::layouts.grids.12')

@section('title', trans('rules::seat.create', ))
@section('page_header', trans('rules::seat.create', ))
@section('page_description', trans('rules::seat.create'))

@section('full')
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-tools">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">
                            <form method="post" action="{{ route('rules.store') }}" enctype="multipart/form-data" id="squad-form">
                                {!! csrf_field() !!}
                                <div class="form-group row">
                                    <label for="language" class="col-sm-2 col-form-label">{{ trans('rules::seat.language') }}</label>
                                    <div class="col-sm-10">
                                        <select name="language" id="language" class="form-control">
                                            @foreach($languages as $language)
                                                <option value="{{$language['short']}}">{{$language['full']}}</option>
                                            @endforeach
                                            @foreach($alliances as $alliance)
                                                <option value="alliance,{{$alliance->alliance_id}}">{{$alliance->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="object" class="col-sm-2 col-form-label">{{ trans('rules::seat.corp_or_alli') }}</label>
                                    <div class="col-sm-10">
                                        <select name="object" id="object" class="form-control">
                                            <optgroup label="Corporations">
                                            @foreach($corporations as $corporation)
                                                <option value="corporation,{{$corporation->corporation_id}}">{{$corporation->name}}</option>
                                            @endforeach
                                            </optgroup>
                                            <optgroup label="Alliances">
                                            @foreach($alliances as $alliance)
                                                <option value="alliance,{{$alliance->alliance_id}}">{{$alliance->name}}</option>
                                            @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                <textarea name="content" id="content" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div id="squad-description"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button type="submit" form="squad-form" class="btn btn-success">
                            <i class="fas fa-"></i> Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('head')
@endpush

@push('javascript')
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>

@endpush
