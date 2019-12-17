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
                            <small>{{ {{ date('d.m.Y H:i:s', strtotime($item->created_at->timezone('Moscow'))) }} }}</small>
                        </p>
                        
                    </div>
                @else
                    <div class="col-4 col-sm-12 col-sm-offset-4">
                        <p>
                            <small>{{ $item->created_at }}</small>
                            {{ $item->message }}
                        </p>
                        
                    </div>
                @endif
            @endforeach
            <form action="">
                <div class="col-4 col-sm-12">
                    <input type="text" name="" id="" class="form-control">
                </div>    
                <input type="submit" value="Ответить">
            </form>
        </div>
    </div>
</div>

@endsection