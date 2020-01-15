@extends('layouts.adminApp')

@section('content')

<div class="col-sm-12 tabs-content">
    <div class="row justify-content-center cont-m">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" action="{{ route('auth.grants.store') }}" enctype="multipart/form-data">
                <textarea name="" id="" cols="30" rows="10" style="width: 100%"></textarea>
            </form>
        </div>
    </div>
</div>

@endsection