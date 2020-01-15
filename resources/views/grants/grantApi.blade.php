@extends('layouts.apiApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            @if($grant)
            <p>{!! htmlspecialchars_decode($grant->grant) !!}</p>
            @endif
        </div>
    </div>
</div>

@endsection