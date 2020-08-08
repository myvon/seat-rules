@extends('web::layouts.grids.12')

@section('title', trans('rules::seat.create', ))
@section('page_header', trans('rules::seat.create', ))
@section('page_description', trans('rules::seat.create'))

@section('full')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <form method="post" action="{{ route('rules.edit.post', ['rule' => $rule->id]) }}" enctype="multipart/form-data" id="squad-form">
                                {!! csrf_field() !!}
                                <div class="form-group row">
                                    <label for="language" class="col-sm-2 col-form-label">{{ trans('rules::seat.language') }}</label>
                                    <div class="col-sm-10">
                                        {{$rule->language}}
                                        <input type="hidden" name="language" value="{{$rule->language}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="object" class="col-sm-2 col-form-label">{{ trans('rules::seat.corp_or_alli') }}</label>
                                    <div class="col-sm-10">
                                        @if($rule->object_type === "alliance")
                                            <input type="hidden" name="object" value="alliance,{{$rule->getObject()->alliance_id}}">
                                            @include('web::partials.alliance', ['alliance' => $rule->getObject()])
                                        @else
                                            <input type="hidden" name="object" value="corporation,{{$rule->getObject()->corporation_id}}">
                                            @include('web::partials.corporation', ['corporation' => $rule->getObject()])
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                <textarea name="content" id="content" rows="30" class="form-control">{!! $rule->content !!}</textarea>
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
