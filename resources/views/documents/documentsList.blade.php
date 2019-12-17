@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" action="{{ route('auth.documents.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="docs[]" class="form-control" multiple required>
                <select name="section">
                    <option value="1. Регистрация НКО">1. Регистрация НКО</option>
                    <option value="1.1. Создание и регистрация НКО">1.1. Создание и регистрация НКО</option>
                    <option value="1.2. Реоргазинация НКО">1.2. Реоргазинация НКО</option>
                    <option value="1.3. Ликвидация НКО">1.3. Ликвидация НКО</option>
                    <option value="1.4. Внесение изменений в сведения ЕГРЮЛ">1.4. Внесение изменений в сведения ЕГРЮЛ</option>
                    <option value="1.5. Внесение изменений в Устав НКО">1.5. Внесение изменений в Устав НКО</option>
                    <option value="1.6. Основания для отказа в государственной регистрации">1.6. Основания для отказа в государственной регистрации</option>
                    <option value="2. Включение в реестр ИОПУ">2. Включение в реестр ИОПУ</option>
                    <option value="3. Отчетность НКО">3. Отчетность НКО</option>
                    <option value="3.1. Казачьи общества">3.1. Казачьи общества</option>
                    <option value="3.2. НКО (АНО, Ассоциации, Союзы, Фонды и другие)">3.2. НКО (АНО, Ассоциации, Союзы, Фонды и другие)</option>
                    <option value="3.3. Общественные объединения">3.3. Общественные объединения</option>
                    <option value="3.4. Профсоюзы">3.4. Профсоюзы</option>
                    <option value="3.5. Религиозные организации">3.5. Религиозные организации</option>
                    <option value="3.6. Способы предоставления отчетности">3.6. Способы предоставления отчетности</option>
                    <option value="4. Обязанности и ответственность НКО">4. Обязанности и ответственность НКО</option>
                </select>
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
                        <td>{{ stristr($item->doc, '/') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection