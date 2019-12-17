@extends('layouts.adminApp')

@section('content')
    
<form class="form-horizontal" method="POST" action="{{ route('auth.events.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('event_head') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="event_head" class="control-label text-tc">Заголовок</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input id="event_head" type="text" class="form-control" name="event_head" value="{{ old('event_head') }}" required maxlength="191">

            @if ($errors->has('event_head'))
                <span class="help-block">
                    <strong>{{ $errors->first('event_head') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('event_body') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="event_body" class="control-label text-tc">Текст</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <textarea id="event_body" type="text" class="md-textarea form-control" name="event_body" cols="30" rows="10" maxlength="2000">{{ old('event_body') }}</textarea>

            @if ($errors->has('event_body'))
                <span class="help-block">
                    <strong>{{ $errors->first('event_body') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('event_place') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="event_place" class="control-label text-tc">Место проведения мероприятия</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="text" class="form-control" name="event_place" value="{{ old('event_place') }}" required>

            @if ($errors->has('event_place'))
                <span class="help-block">
                    <strong>{{ $errors->first('event_place') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('event_date') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="event_date" class="control-label text-tc">Дата проведения мероприятия</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="date" class="form-control" name="event_date" value="{{ old('event_date') }}" required>

            @if ($errors->has('event_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('event_date') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-tc-ct">
                Сохранить
            </button>
        </div>
    </div>

</form>

@endsection