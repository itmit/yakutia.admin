@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.contacts.create') }}" class="btn-card">Создать контакт</a>
            </div>
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col">Руководитель</th>
                    <th scope="col">Адрес</th>
                    <th scope="col">Телефон</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $item)
                    <tr>
                        <td><a href="contacts/{{ $item->id }}"> {{ $item->name }} </a></td>
                        <td>{{ $item->supervisor }}</td>
                        <td>{{ $item->adress }}</td>
                        <td>{{ $item->phone }}</td>
                        <td><i class="material-icons delete-contest" style="cursor: pointer" data-id="{{ $item->id }}">delete</i></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <script>

$(document).on('click', '.delete-contest', function() {
    let isDelete = confirm("Удалить конкурс? Данное действие невозможно отменить!");

    if(isDelete)
    {
        let place = $(this).closest('tr');
        let id = $(this).data('id');
        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data    : { id: id },
            url     : 'contests/delete',
            method    : 'delete',
            success: function (response) {
                place.remove();
                console.log('Удалено!');
            },
            error: function (xhr, err) { 
                console.log("Error: " + xhr + " " + err);
            }
        });
    }
});

</script> --}}

@endsection