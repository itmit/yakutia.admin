@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
<<<<<<< HEAD
                <div class="card-header">{{ __('Login') }}</div>
=======
                <div class="card-header">{{ __('Вход') }}</div>
>>>>>>> 248a153ff3ad6f8de86d6872065cc630a3edf7fc

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
<<<<<<< HEAD
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
=======
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Адрес электронной почты') }}</label>
>>>>>>> 248a153ff3ad6f8de86d6872065cc630a3edf7fc

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
<<<<<<< HEAD
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
=======
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>
>>>>>>> 248a153ff3ad6f8de86d6872065cc630a3edf7fc

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
<<<<<<< HEAD
                                        {{ __('Remember Me') }}
=======
                                        {{ __('Запомнить меня') }}
>>>>>>> 248a153ff3ad6f8de86d6872065cc630a3edf7fc
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
<<<<<<< HEAD
                                    {{ __('Login') }}
=======
                                    {{ __('Вход') }}
>>>>>>> 248a153ff3ad6f8de86d6872065cc630a3edf7fc
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
<<<<<<< HEAD
                                        {{ __('Forgot Your Password?') }}
=======
                                        {{ __('Забыли пароль?') }}
>>>>>>> 248a153ff3ad6f8de86d6872065cc630a3edf7fc
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
