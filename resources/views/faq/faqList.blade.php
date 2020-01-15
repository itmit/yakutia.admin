@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.faq.create') }}" class="btn-card">Создать пару вопрос-ответ</a>
            </div>
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Вопрос</th>
                    <th scope="col">Ответ</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($faq as $item)
                    <tr>
                        <td>{{ $item->question }}</td>
                        <td>{{ $item->answer }}</td>
                        <td><i class="material-icons delete-faq" style="cursor: pointer" data-id="{{ $item->id }}">delete</i></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

$(document).on('click', '.delete-faq', function() {
    let isDelete = confirm("Удалить контакт? Данное действие невозможно отменить!");

    if(isDelete)
    {
        let faq = $(this).closest('tr');
        let id = $(this).data('id');
        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data    : { id: id },
            url     : 'faq/delete',
            method    : 'delete',
            success: function (response) {
                faq.remove();
            },
            error: function (xhr, err) { 
                console.log("Error: " + xhr + " " + err);
            }
        });
    }
});

</script>

@endsection