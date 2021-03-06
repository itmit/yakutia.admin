@extends('layouts.adminApp')

@section('content')
<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <div class="group-btn-card">
                <a href="{{ route('auth.cases.create') }}" class="btn btn-primary">Добавить кейс</a>
            </div>
            @foreach($cases as $item)

            <div class="row">
                <div class="col-sm-12">
                        <h1>
                            {{ $item->head }}<i class="material-icons delete-case" style="cursor: pointer" data-id="{{ $item->id }}">delete</i>
                            <a href="cases/{{ $item->id }}/edit"><i class="material-icons">edit</i></a>
                        </h1>
                    <div class="row">
                    <div class="col-4 col-sm-12">
                        <img src="{{ $item->picture }}" alt="{{ $item->head }}" width="35%" style="float:left; margin: 7px 7px 7px 0;">
                        {!! htmlspecialchars_decode($item->body) !!}
                    </div>
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
</div>
    
<script>

$(document).on('click', '.delete-case', function() {
    let isDelete = confirm("Удалить кейс? Данное действие невозможно отменить!");

    if(isDelete)
    {
        let elem = $(this).closest('.row');
        let id = $(this).data('id');
        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            data    : { id: id },
            url     : 'cases/delete',
            method    : 'delete',
            success: function (response) {
                elem.remove();
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