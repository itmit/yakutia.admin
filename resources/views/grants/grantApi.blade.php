@extends('layouts.apiApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <textarea name="grant" style="width: 100%">@if($grant){{ $grant->grant }}@endif</textarea>
        </div>
    </div>
</div>

@endsection