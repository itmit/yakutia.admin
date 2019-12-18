@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.mods.create') }}" class="btn-card">Создать модератора</a>
            </div>
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Имя (никнейм)</th>
                    <th scope="col">Электронная почта</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($mods as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td><i class="material-icons delete-mod" style="cursor: pointer" data-id="{{ $item->id }}">delete</i></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

$(document).on('click', '.delete-mod', function() {
    let isDelete = confirm("Удалить событие? Данное действие невозможно отменить!");

    if(isDelete)
    {
        let id = $(this).data('id');
        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data    : { id: id },
            url     : 'mods/delete',
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