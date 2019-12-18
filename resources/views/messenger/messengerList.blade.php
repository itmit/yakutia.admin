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
                        $chat = null;
                        $chat = $item->lastMessage();
                    ?>
                    <tr data-href="messenger/{{ $item->id }}"
                        @if($chat != NULL && $chat->direction == 0)
                        style="color: red; cursor: pointer"
                        @elseif($chat != NULL && $chat->direction == 0)
                        style="cursor: pointer"
                        @endif
                    >
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        @if(!$chat)
                        <td></td>
                        @else
                        <td>{{ date('H:i:s d.m.Y', strtotime($chat->created_at->timezone('Europe/Moscow'))) }}</td>
                        @endif
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