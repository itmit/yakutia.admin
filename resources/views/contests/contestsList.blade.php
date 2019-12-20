@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.contests.create') }}" class="btn-card">Создать конкурс</a>
            </div>
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col">Уровень</th>
                    <th scope="col">Дата начала</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($contests as $item)
                    <tr>
                        <td><a href="contests/{{ $item->id }}"> {{ $item->name }} </a></td>
                        <td>{{ $item->level }}</td>
                        {{-- <td>{{ date('d.m.Y', strtotime($item->date_start)) }}</td> --}}
                        <td><i class="material-icons delete-event" style="cursor: pointer" data-id="{{ $item->id }}">delete</i></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

$(document).on('click', '.delete-contest', function() {
    let isDelete = confirm("Удалить конкурс? Данное действие невозможно отменить!");

    // if(isDelete)
    // {
    //     let id = $(this).data('id');
    //     $.ajax({
    //         headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //         dataType: "json",
    //         data    : { id: id },
    //         url     : 'events/delete',
    //         method    : 'delete',
    //         success: function (response) {
    //             $(this).closest('tr').remove();
    //             console.log('Удалено!');
    //         },
    //         error: function (xhr, err) { 
    //             console.log("Error: " + xhr + " " + err);
    //         }
    //     });
    // }
});

</script>

@endsection