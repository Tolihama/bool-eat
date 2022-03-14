@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-3">
                    <h2 class="mb-0">{{ __('Registrati su Bool Eat') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                <i class="fa-solid fa-user icon mr-2"></i>{{ __('Nome e cognome') }}
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                <i class="fa-solid fa-at icon mr-2"></i>{{ __('E-Mail') }}
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                <i class="fa-solid fa-key icon mr-2"></i>{{ __('Password') }}
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                <i class="fa-solid fa-key icon mr-2"></i>{{ __('Conferma Password') }}
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="pt-4 pb-3 px-4">
                            <h3 class="h5">Campi facoltativi</h3>
                            <h4 class="h6">Puoi compilare questi campi in seguito.</h4>
                        </div>


                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">
                                <i class="fa-solid fa-book icon mr-2"></i>{{ __('Biografia') }}
                            </label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="bio" id="bio" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">
                                <i class="fa-solid fa-image icon mr-2"></i>{{ __('Avatar (foto profilo)') }}
                            </label>

                            <div class="col-md-6">
                                <input class="form-control" type="file" name="avatar" id="avatar">
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrati') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
