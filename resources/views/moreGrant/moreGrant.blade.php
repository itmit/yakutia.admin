@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" action="g{{ $t }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <textarea name="grant" style="width: 100%">@if($grant){{ $grant->grant }}@endif</textarea>
                <div class="row form-group{{ $errors->has('more_grant_files') ? ' has-error' : '' }}">
                    <div class="col-xs-12 col-sm-2">
                    <label for="more_grant_files" class="control-label text-tc">Документы</label>
                    </div>
            
                    <div class="col-xs-12 col-sm-10">
                        <input type="file" name="docs[]" class="form-control" multiple required>
            
                        @if ($errors->has('more_grant_files'))
                            <span class="help-block">
                                <strong>{{ $errors->first('more_grant_files') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="t" value={{ $t }}>
                <input type="submit" value="Сохранить">
            </form>
        </div>
    </div>
</div>

@endsection