@extends('layouts.adminApp')

@section('content')
    
    <a href="{{ route('auth.cases.create') }}" class="btn btn-primary">Добавить кейс</a>

    <br>

    @foreach($cases as $item)

    <div class="row">
        <div class="col-sm-12">
                <h1>{{ $item->head }}</h1>
            <div class="row">
            <div class="col-4 col-sm-12">
                <img src="{{ $item->picture }}" alt="{{ $item->head }}" width="35%" style="float:left; margin: 7px 7px 7px 0;">
                {!! htmlspecialchars_decode($item->body) !!}
            </div>
            </div>
        </div>
    </div>
    
    @endforeach

@endsection