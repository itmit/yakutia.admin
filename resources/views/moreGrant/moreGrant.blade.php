@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" action="g{{ $t }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <textarea name="grant" style="width: 100%">@if($grant){{ $grant->grant }}@endif</textarea>
                <input type="hidden" name="t" value={{ $t }}>
                <input type="submit" value="Сохранить">
            </form>
        </div>
    </div>
</div>

@endsection