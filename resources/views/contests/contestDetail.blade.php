@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <h2>{{ $contest->name }} {{ $contest->level }}</h2>

            <a href="../contests">Назад</a>

            <p>
                {{ $contest->description }}
            </p>

            <div class="row">
                @foreach($files as $item)

                <div class="col-md-4">
                    <div class="thumbnail">
                    <a href="{{ $item->document }}">
                        <img src="{{ $item->document }}"style="width:100%">
                        $item->document
                    </a>
                    </div>
                </div>
                
                @endforeach
            </div>
        </div>
    </div>
</div> 

@endsection