@extends('layouts.adminApp')

@section('content')
    
<form class="form-horizontal" method="POST" action="{{ route('auth.faq.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('faq_question') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-3">
        <label for="faq_question" class="control-label text-tc">Вопрос</label>
        </div>

        <div class="col-xs-12 col-sm-9">
            <input id="faq_question" type="text" class="form-control" name="faq_question" value="{{ old('faq_question') }}" required maxlength="191">

            @if ($errors->has('faq_question'))
                <span class="help-block">
                    <strong>{{ $errors->first('faq_question') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('faq_answer') ? ' has-error' : '' }}">
        <div class="col-xs-12 col-sm-3">
        <label for="faq_answer" class="control-label text-tc">Ответ</label>
        </div>

        <div class="col-xs-12 col-sm-9">
            <input>
            <textarea id="faq_answer" type="text" class="form-control" name="faq_answer" required></textarea>

            @if ($errors->has('faq_answer'))
                <span class="help-block">
                    <strong>{{ $errors->first('faq_answer') }}</strong>
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