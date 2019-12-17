@extends('layouts.adminApp')

@section('content')
    
<form class="form-horizontal" method="POST" action="{{ route('auth.mods.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('mod_name') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="mod_name" class="control-label text-tc">Имя (никнейм)</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input id="mod_name" type="text" class="form-control" name="mod_name" value="{{ old('mod_name') }}" required maxlength="191">

            @if ($errors->has('mod_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('mod_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="email" class="control-label text-tc">Электронная почта</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="password" class="control-label text-tc">Пароль</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="password_confirmation" class="control-label text-tc">Повторите пароль</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="password" class="form-control" name="password_confirmation" value="" required>

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
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