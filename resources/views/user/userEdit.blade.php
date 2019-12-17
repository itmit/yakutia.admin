@extends('layouts.adminApp')

@section('content')
    
<form class="form-horizontal" method="HEAD" action="{{ route('auth.user.edit', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    @if($suc == 1)
    <h2 style="color: green">Пароль успешно изменен!</h2>
    @endif

    <div class="row form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="old_password" class="control-label text-tc">Текущий пароль</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}" required>

            @if ($errors->has('old_password'))
                <span class="help-block">
                    <strong>{{ $errors->first('old_password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('old_password_confirmation') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="old_password_confirmation" class="control-label text-tc">Повторите текущий пароль</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="password" class="form-control" name="old_password_confirmation" value="" required>

            @if ($errors->has('old_password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('old_password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="new_password" class="control-label text-tc">Новый пароль</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="password" class="form-control" name="new_password" value="" required>

            @if ($errors->has('new_password'))
                <span class="help-block">
                    <strong>{{ $errors->first('new_password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="new_password_confirmation" class="control-label text-tc">Повторите новый пароль</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input type="password" class="form-control" name="new_password_confirmation" value="" required>

            @if ($errors->has('new_password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
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