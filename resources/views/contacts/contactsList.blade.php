@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.contacts.create') }}" class="btn btn-primary">Создать контакт</a>
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
                        <td><i class="material-icons delete-contact" style="cursor: pointer" data-id="{{ $item->id }}">delete</i></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

$(document).on('click', '.delete-contact', function() {
    let isDelete = confirm("Удалить контакт? Данное действие невозможно отменить!");

    if(isDelete)
    {
        let contact = $(this).closest('tr');
        let id = $(this).data('id');
        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data    : { id: id },
            url     : 'contacts/delete',
            method    : 'delete',
            success: function (response) {
                contact.remove();
            },
            error: function (xhr, err) { 
                console.log("Error: " + xhr + " " + err);
            }
        });
    }
});

</script>

@endsection