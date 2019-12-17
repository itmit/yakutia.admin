@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.events.create') }}" class="btn-card">Создать событие</a>
            </div>
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col">Место проведения</th>
                    <th scope="col">Дата начала</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $item)
                    <tr>
                        <td><a href="events/{{ $item->id }}"> {{ $item->head }} </a></td>
                        <td>{{ $item->place }}</td>
                        <td>{{ date('d.m.Y', strtotime($item->date_start)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection