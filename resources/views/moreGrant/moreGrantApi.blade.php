@extends('layouts.apiApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            @if($grant)
            <p>{!! htmlspecialchars_decode($grant->grant) !!}</p>
            @endif
            @foreach ($files as $file)
            <p>
                <a href="{{ $file->file }}">
                    {{ substr(strrchr($file->file, '/'), 1) }}
                </a>
            </p>
            @endforeach
        </div>
    </div>
</div>

@endsection