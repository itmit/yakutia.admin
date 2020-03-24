@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" action="g{{ $t }}/store" enctype="multipart/form-data">
                {{ csrf_field() }}
                <textarea name="grant" style="width: 100%">@if($grant){{ $grant->grant }}@endif</textarea>
                <div class="row form-group{{ $errors->has('more_grant_files') ? ' has-error' : '' }}">
                    <div class="col-xs-12 col-sm-2">
                    <label for="more_grant_files" class="control-label text-tc">Документы</label>
                    </div>
            
                    <div class="col-xs-12 col-sm-10">
                        <input type="file" name="docs[]" class="form-control" multiple required>
            
                        @if ($errors->has('more_grant_files'))
                            <span class="help-block">
                                <strong>{{ $errors->first('more_grant_files') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="t" value={{ $t }}>
                <input type="submit" value="Сохранить">
            </form>
            @foreach ($files as $file)
            <p>
                <a href="{{ $file->file }}">
                    {{ substr(strrchr($file->file, '/'), 1) }}
                </a>
                <span class="material-icons delete-file" style="cursor: pointer" data-file="{{$file->id}}">
                    delete_forever
                </span>
            </p>
            @endforeach
        </div>
    </div>
</div>
<script>
$(document).ready(function()
    {
        $('.delete-file').click(function () {
            let isDel = confirm("Удалить файл?");
            if(isDel)
            {
                let file = $(this).data('file');
                let delFile =  $(this).closest('p');
                console.log(delFile);
                // $.ajax({
                //     headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                //     dataType: "json",
                //     data    : { file: file },
                //     url     : '../deleteMoreGrantsFile',
                //     method    : 'post',
                //     success: function (response) {
                //         delFile.remove();
                //     },
                //     error: function (xhr, err) { 
                //         console.log("Error: " + xhr + " " + err);
                //     }
                // });
            }
        })
    })
</script>
@endsection