@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1>Il tuo ristorante: {{$restaurant->name}}</h1>
                <div>
                    <strong>Indirizzo:</strong> {{$restaurant->address}}
                </div>
                <div>
                    <strong>Partita IVA:</strong> {{$restaurant->vat}}
                </div>
                <h4>Immagine Profilo</h4>
                <div class="thumb img-fluid">
                    <img src="{{asset('/storage/' . $restaurant->thumb)}}" alt="{{$restaurant->name}}">
                </div>
                <h4>Immagine Copertina</h4>
                <div class="cover img-fluid">
                    <img src="{{asset('/storage/' . $restaurant->cover)}}" alt="{{$restaurant->name}}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="cta mb-3">
                    <a href="{{route('admin.restaurant.edit', $restaurant->slug)}}" class="btn btn-primary w-50">Modifica dati ristorante</a>
                </div>
                <form action="{{route('admin.restaurant.destroy', $restaurant->slug)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger w-50">Elimina ristorante</button>
        
                </form>
            </div>
        </div>
        

        
        

        

        
        

        

    </div>
@endsection