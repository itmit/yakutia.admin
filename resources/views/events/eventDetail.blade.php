@extends('layouts.adminApp')

@section('content')
    
<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <h2>Мероприятие {{ $event->head }}</h2>
            <div class="col-4 col-sm-12">
                <p>
                    {!! htmlspecialchars_decode($event->body) !!}
                </p>
            </div>
            <div class="col-4 col-sm-12">
                Дата проведения: {{ date('d.m.Y', strtotime($event->date_start)) }}
            </div>
            <div class="col-4 col-sm-12">
                Место проведения: {{ $event->place }}
            </div>
            <h3>Зарегистрированные участники (всего: {{ count($users) }} человек(а))</h3>
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Электронная почта</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        <td>{{ $item['name']}}</td>
                        <td>{{ $item['email'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection