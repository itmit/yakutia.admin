@extends('layouts.adminApp')

@section('content')
    
    <a href="{{ route('auth.cases.create') }}" class="btn btn-primary">Добавить кейс</a>

    <br>

    @foreach($cases as $item)

    <div class="row">
        <div class="col-sm-12">
                <h1>{{ $item->head }}<i class="material-icons delete-case" style="cursor: pointer" data-id="{{ $item->id }}">delete</i></h1>
            <div class="row">
            <div class="col-4 col-sm-12">
                <img src="{{ $item->picture }}" alt="{{ $item->head }}" width="35%" style="float:left; margin: 7px 7px 7px 0;">
                {!! htmlspecialchars_decode($item->body) !!}
            </div>
            </div>
        </div>
    </div>
    
    @endforeach

<script>

$(document).on('click', '.delete-case', function() {
    let isDelete = confirm("Удалить кейс? Данное действие невозможно отменить!");

    if(isDelete)
    {
        let id = $(this).data('id');
        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data    : { id: id },
            url     : 'cases/delete',
            method    : 'delete',
            success: function (response) {
                $(this).closest('.row').remove();
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