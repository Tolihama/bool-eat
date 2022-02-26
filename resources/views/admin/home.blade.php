@extends('layouts.app')

@section('content')
<div id="dashboard" class="container py-5">
    <h1>Dashboard di {{ Auth::user()->name }}</h1>

    <div class="row py-3">
        <div class="col-sm-12 col-md-6 p-3 h-100">
            <div class="card d-flex flex-column h-100">
                <h2>Il tuo ristorante</h2>
                <div class="flex-grow-1">
                    @if ($user_restaurant)
                        <p>Dettagli del tuo ristorante...</p>
                    @else
                        <p>
                            Non hai ancora registrato il tuo ristorante!<br>
                            <a href="{{ route('admin.restaurant.create') }}">Registralo adesso!</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 p-3 h-100">
            <div class="card d-flex flex-column h-100">
                <h2>I tuoi ordini</h2>
                <div class="flex-grow-1">
                    Feature da implementare
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 p-3 h-100">
            <div class="card d-flex flex-column h-100">
                <h2>Il tuo menù</h2>
                <div class="flex-grow-1">
                    @if ($user_restaurant)
                        <p>Dettagli del tuo ristorante...</p>
                    @else
                        <p>
                            Non puoi aggiungere piatti al tuo menù se prima non registri il tuo ristorante!<br>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 p-3 h-100">
            <div class="card d-flex flex-column h-100">
                <h2>Il tuo profilo</h2>
                <div class="flex-grow-1">
                    Feature da implementare
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
