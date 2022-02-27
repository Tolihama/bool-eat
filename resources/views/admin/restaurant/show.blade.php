@extends('layouts.app')

@section('content')
    <div class="container restaurant-show py-5">
        <h1 class="mb-5">Il tuo ristorante: {{$restaurant->name}}</h1>
        <div class="row">
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">

                <div class="thumb mb-4 text-center">
                    <h4>Immagine Profilo</h4>
                    <div class="thumb-img">
                        <img src="{{asset('/storage/' . $restaurant->thumb)}}" alt="{{$restaurant->name}}">
                    </div>
                </div>
                
                <h4>Immagine Copertina</h4>
                <div class="cover text-center">
                    <img src="{{asset('/storage/' . $restaurant->cover)}}" alt="{{$restaurant->name}}">
                </div>

            </div>

            <div class="col-12 col-md-6">
                <h3 class="mb-3">I tuoi dati</h3>
                <div>
                    <strong>Indirizzo:</strong> {{$restaurant->address}}
                </div>
                <div>
                    <strong>Partita IVA:</strong> {{$restaurant->vat}}
                </div>
                <div class="mb-5">
                    <strong>Categorie:</strong>
                    <ul>
                        @foreach ($restaurant->categories as $category)
                            <li>
                                {{ $category->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="cta my-3">
                    <a href="{{ route('admin.restaurant.edit', $restaurant->slug) }}" class="btn btn-warning w-50">
                        <i class="fa-solid fa-square-pen mr-2"></i> Modifica dati ristorante
                    </a>
                </div>
                <form action="{{ route('admin.restaurant.destroy', $restaurant->slug) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger w-50">
                        <i class="fa-solid fa-eraser mr-2"></i> Elimina ristorante
                    </button>
        
                </form>
            </div>
        </div>
        

        
        

        

        
        

        

    </div>
@endsection