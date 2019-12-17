@extends('layouts.adminApp')

@section('content')
    
<form class="form-horizontal" method="POST" action="{{ route('auth.cases.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('case_head') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="case_head" class="control-label text-tc">Заголовок</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input id="case_head" type="text" class="form-control" name="case_head" value="{{ old('case_head') }}" required maxlength="191">

            @if ($errors->has('case_head'))
                <span class="help-block">
                    <strong>{{ $errors->first('case_head') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('case_body') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="case_body" class="control-label text-tc">Текст</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <textarea id="case_body" type="text" class="md-textarea form-control" name="case_body" cols="30" rows="10" maxlength="2000">{{ old('case_body') }}</textarea>

            @if ($errors->has('case_body'))
                <span class="help-block">
                    <strong>{{ $errors->first('case_body') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('case_picture') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="case_picture" class=" control-label text-tc">Картинка</label>
        </div>
    
        <div class="col-xs-12 col-sm-10">
            <input type="file" name="case_picture" id="case_picture" class="form-control-file" accept="image/*" required>

            @if ($errors->has('case_picture'))
                <span class="help-block">
                    <strong>{{ $errors->first('case_picture') }}</strong>
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