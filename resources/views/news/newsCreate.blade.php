@extends('layouts.adminApp')

@section('content')
    
<form class="form-horizontal" method="POST" action="{{ route('auth.news.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('news_head') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="news_head" class="control-label text-tc">Заголовок</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <input id="news_head" type="text" class="form-control" name="news_head" value="{{ old('news_head') }}" required maxlength="191">

            @if ($errors->has('news_head'))
                <span class="help-block">
                    <strong>{{ $errors->first('news_head') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('news_body') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="news_body" class="control-label text-tc">Текст</label>
        </div>

        <div class="col-xs-12 col-sm-10">
            <textarea id="news_body" type="text" class="md-textarea form-control" name="news_body" cols="30" rows="10" maxlength="2000">{{ old('news_body') }}</textarea>

            @if ($errors->has('news_body'))
                <span class="help-block">
                    <strong>{{ $errors->first('news_body') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('news_picture') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-2">
        <label for="news_picture" class=" control-label text-tc">Картинка</label>
        </div>
    
        <div class="col-xs-12 col-sm-10">
            <input type="file" name="news_picture" id="news_picture" class="form-control-file" accept="image/*" required>

            @if ($errors->has('news_picture'))
                <span class="help-block">
                    <strong>{{ $errors->first('news_picture') }}</strong>
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