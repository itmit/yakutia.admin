@extends('layouts.adminApp')

@section('content')
    
<form class="form-horizontal" method="POST" action="/contacts/{{ $id }}" enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('сontact_name') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-3">
        <label for="сontact_name" class="control-label text-tc">Наименование</label>
        </div>

        <div class="col-xs-12 col-sm-9">
            <input id="сontact_name" type="text" class="form-control" name="сontact_name" value="{{ $contact->name }}" required maxlength="191">

            @if ($errors->has('сontact_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('сontact_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('сontact_supervisor') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-3">
        <label for="сontact_supervisor" class="control-label text-tc">Руководитель</label>
        </div>

        <div class="col-xs-12 col-sm-9">
            <input id="сontact_supervisor" type="text" class="form-control" name="сontact_supervisor" value="{{ $contact->supervisor }}" required maxlength="191">

            @if ($errors->has('сontact_supervisor'))
                <span class="help-block">
                    <strong>{{ $errors->first('сontact_supervisor') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('сontact_adress') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-3">
        <label for="сontact_adress" class="control-label text-tc">Адрес</label>
        </div>

        <div class="col-xs-12 col-sm-9">
            <input id="сontact_adress" type="text" class="form-control" name="сontact_adress" value="{{ $contact->adress }}" required maxlength="191">

            @if ($errors->has('сontact_adress'))
                <span class="help-block">
                    <strong>{{ $errors->first('сontact_adress') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('сontact_phone') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-3">
        <label for="сontact_phone" class="control-label text-tc">Телефон</label>
        </div>

        <div class="col-xs-12 col-sm-9">
            <input id="сontact_phone" id="сontact_phone" type="text" class="form-control" name="сontact_phone" value="{{ $contact->phone }}" required maxlength="191">

            @if ($errors->has('сontact_phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('сontact_phone') }}</strong>
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

<script>
$(function(){
    //$("#сontact_phone").mask("+7 (999) 999 99-99");
});
</script>

@endsection