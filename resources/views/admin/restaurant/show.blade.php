@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>Il tuo ristorante</h1>
        <div class="cover">
            <img src="{{asset('/storage/' . $restaurant->cover)}}" alt="{{$restaurant->name}}">
        </div>

        <h2>Nome: {{$restaurant->name}}</h2>
        <div class="thumb">
            <img src="{{asset('/storage/' . $restaurant->thumb)}}" alt="{{$restaurant->name}}">
        </div>

        <div>
            <strong>Indirizzo:</strong> {{$restaurant->address}}
        </div>

        <div>
            <strong>Partita IVA:</strong> {{$restaurant->vat}}
        </div>
        <div class="cta">
            <a href="{{route('admin.restaurant.edit', $restaurant->slug)}}" class="btn btn-primary">Modifica dati ristorante</a>
        </div>

        <form action="{{route('admin.restaurant.destroy', $restaurant->slug)}}" method="POST">
            @csrf
            @method('DELETE')
            
            <button type="submit" class="btn btn-danger">Elimina ristorante</button>

        </form>

    </div>
@endsection