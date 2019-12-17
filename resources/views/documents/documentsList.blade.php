@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <form action="" method="post">
                <input type="file" name="docs" class="form-control" multiple required>
                <input type="submit" value="Загрузить">
            </form>
        </div>
    </div>
</div>

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Раздел</th>
                    <th scope="col">Документы</th>
                </tr>
                </thead>
                <tbody>
                @foreach($docs as $item)
                    <tr>
                        <td>{{ $item->section }}</td>
                        <td>{{ $item->doc }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection