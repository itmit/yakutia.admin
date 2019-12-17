<<<<<<< HEAD
@extends('layouts.app')
=======
@extends('layouts.adminApp')
>>>>>>> 248a153ff3ad6f8de86d6872065cc630a3edf7fc

@section('content')
<div class="container">
    <div class="row justify-content-center">
<<<<<<< HEAD
        <div class="col-md-8">
=======
        <div class="col-md-12">
>>>>>>> 248a153ff3ad6f8de86d6872065cc630a3edf7fc
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
