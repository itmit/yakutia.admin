@extends('layouts.adminApp')

@section('content')
    
<form class="form-horizontal" method="POST" action="{{ route('auth.contests.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('contest_name') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="contest_name" class="control-label text-tc">Заголовок</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input id="contest_name" type="text" class="form-control" name="contest_name" value="{{ old('contest_name') }}" required maxlength="191">

            @if ($errors->has('contest_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('contest_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('contest_level') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="contest_level" class="control-label text-tc">Текст</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <select name="contest_level" class="form-control">
                <option value="региональный">Региональный</option>
                <option value="федеральный">Федеральный</option>
            </select>

            @if ($errors->has('contest_level'))
                <span class="help-block">
                    <strong>{{ $errors->first('contest_level') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('contest_description') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="contest_description" class="control-label text-tc">Место проведения мероприятия</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <textarea id="contest_description" type="text" class="md-textarea form-control" name="contest_description" cols="30" rows="10" maxlength="2000">{{ old('contest_description') }}</textarea>

            @if ($errors->has('contest_description'))
                <span class="help-block">
                    <strong>{{ $errors->first('contest_description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('contest_files') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="contest_files" class="control-label text-tc">Документы</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="file" name="docs[]" class="form-control" multiple required>

            @if ($errors->has('contest_files'))
                <span class="help-block">
                    <strong>{{ $errors->first('contest_files') }}</strong>
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