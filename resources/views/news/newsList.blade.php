@extends('layouts.adminApp')

@section('content')
    
    <a href="{{ route('auth.news.create') }}" class="btn btn-primary">Добавить новость</a>

    <br>

    @foreach($news as $newsItem)

    <div class="row">
        <div class="col-sm-12">
                <h1>{{ $newsItem->head }}</h1>
            <div class="row">
            <div class="col-4 col-sm-12">
                <img src="{{ $newsItem->picture }}" alt="{{ $newsItem->head }}" width="35%" style="float:left; margin: 7px 7px 7px 0;">
                {!! htmlspecialchars_decode($newsItem->body) !!}
            </div>
            </div>
        </div>
    </div>
    
    @endforeach

@endsection