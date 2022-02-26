@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Dashboard di {{ Auth::user()->name }}</h1>

    <div class="row py-3">
        <div class="col-sm-12 col-md-6">
            <h2>I tuoi ordini</h2>
            <p>Feature da implementare</p>
        </div>

        <div class="col-sm-12 col-md-6">
            <h2>Il tuo menù</h2>
            <p>Feature da implementare</p>
        </div>

        <div class="col-sm-12 col-md-6">
            <h2>Il tuo ristorante</h2>
            <p>Feature da implementare</p>
        </div>

        <div class="col-sm-12 col-md-6">
            <h2>Il tuo profilo</h2>
            <p>Feature da implementare</p>
        </div>
    </div>
</div>
@endsection
