@extends('layouts.app')

@section('content')
    <div class="container restaurant-show py-5">
        <div class="row">
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h1 class="mb-5">Il tuo ristorante: {{$restaurant->name}}</h1>
                
                <div class="thumb mb-4 text-center">
                    <h4>Immagine Profilo</h4>
                    <div class="thumb-img">
                        <img src="{{asset('/storage/' . $restaurant->thumb)}}" alt="{{$restaurant->name}}">
                    </div>
                </div>
                
                <h4>Immagine Copertina</h4>
                <div class="cover">
                    <img src="{{asset('/storage/' . $restaurant->cover)}}" alt="{{$restaurant->name}}">
                </div>
            </div>
            <div class="col-12 col-md-6">

                <h3 class="my-5">I tuoi dati</h3>
                <div>
                    <strong>Indirizzo:</strong> {{$restaurant->address}}
                </div>
                <div class="mb-5">
                    <strong>Partita IVA:</strong> {{$restaurant->vat}}
                </div>
                <div class="cta my-3">
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