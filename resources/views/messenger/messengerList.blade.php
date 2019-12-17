@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <table class="table policy-table">
                <thead>
                <tr>
                    <th scope="col">Клиент</th>
                    <th scope="col">Электронная почта</th>
                    <th scope="col">Последнее сообщение</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messengers as $item)
                    <?
                        $client = $item->client();
                    ?>
                    <tr data-href="messenger/{{ $item->id }}" style="cursor: pointer">
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>Время</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});
</script>

@endsection