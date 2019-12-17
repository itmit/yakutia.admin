@extends('layouts.adminApp')

@section('content')
<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.polls.create') }}" class="btn-card">Создать опрос</a>
                {{-- <button type="button" class="btn-card btn-tc-danger js-destroy-button">Удалить отмеченные опросы</button> --}}
            </div>
            <table class="table policy-table">
                <thead>
                <tr>
                    {{-- <th scope="col"><input type="checkbox" name="destroy-all-polls" class="js-destroy-all"/></th> --}}
                    <th scope="col">Наименование</th>
                    <th scope="col">Дата создания</th>
                </tr>
                </thead>
                <tbody>
                @foreach($polls as $poll)
                    <tr>
                        <td>{{ $poll->name }}</td>
                        <td>{{ $poll->created_at->timezone('Europe/Moscow') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- <script>

$(document).on('click', '.js-destroy-button', function() {
    let isDelete = confirm("Удалить отмеченные опросы? Все результаты прохождений опросов будут утеряны. Данное действие нельзя отменить");

    if(isDelete)
    {
        let ids = [];

        $(".js-destroy:checked").each(function(){
            ids.push($(this).data('pollId'));
        });

        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data    : { ids: ids },
            url     : 'polls/delete',
            method    : 'delete',
            success: function (response) {
                $(".js-destroy:checked").closest('tr').remove();
                $(".js-destroy").prop("checked", "");
            },
            error: function (xhr, err) { 
                console.log("Error: " + xhr + " " + err);
            }
        });
    }
});

</script> --}}
@endsection
