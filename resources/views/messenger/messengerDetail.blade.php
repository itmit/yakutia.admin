@extends('layouts.adminApp')

@section('content')
    
<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <h2>Чат с пользователем {{ $messenger->client()->name }}</h2>
            @foreach($messages as $item)
                @if($item->direction == 0) <!-- когда пишет пользователь это 0, когда админ это 1 -->
                    <div class="col-4 col-sm-12">
                        <p>
                            {{ $item->message }}
                            <small>{{ date('H:i:s d.m.Y', strtotime($item->created_at->timezone('Europe/Moscow'))) }}</small>
                        </p>
                    </div>
                    <hr>
                @else
                    <div class="col-4 col-sm-12 col-sm-offset-7">
                        <p>
                            <small>{{ date('H:i:s d.m.Y', strtotime($item->created_at->timezone('Europe/Moscow'))) }}</small>
                            {{ $item->message }}
                        </p>
                    </div>
                    <hr>
                @endif
            @endforeach
            <form action="{{ route('auth.messenger.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-4 col-sm-12">
                    <input type="text" name="message_answer" class="form-control" required>
                    <input type="hidden" name="i" value="{{ $id }}">
                    <br>
                    <input type="submit" value="Ответить" class="btn btn-primary">
                </div>    
            </form>
        </div>
    </div>
</div>

@endsection