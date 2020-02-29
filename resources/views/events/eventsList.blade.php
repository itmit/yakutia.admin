@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.events.create') }}" class="btn btn-primary">Создать событие</a>
            </div>
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col">Место проведения</th>
                    <th scope="col">Дата начала</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $item)
                    <tr>
                        <td><a href="events/{{ $item->id }}"> {{ $item->head }} </a></td>
                        <td>{{ $item->place }}</td>
                        <td>{{ date('d.m.Y', strtotime($item->date_start)) }}</td>
                        <td><i class="material-icons delete-event" style="cursor: pointer" data-id="{{ $item->id }}">delete</i></td>
                        <td><a href="events/{{ $item->id }}/edit"><i class="material-icons">edit</i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

$(document).on('click', '.delete-event', function() {
    let isDelete = confirm("Удалить событие? Данное действие невозможно отменить!");

    if(isDelete)
    {
        let id = $(this).data('id');
        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data    : { id: id },
            url     : 'events/delete',
            method    : 'delete',
            success: function (response) {
                $(this).closest('tr').remove();
                console.log('Удалено!');
            },
            error: function (xhr, err) { 
                console.log("Error: " + xhr + " " + err);
            }
        });
    }
});

</script>

@endsection