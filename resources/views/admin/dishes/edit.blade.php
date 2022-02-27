@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-5">Modifica: {{$dish_edit->name}}</h1>

        <form action="{{route('admin.dishes.update', $dish_edit->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome piatto</label>
                <input 
                    class="form-control" 
                    type="text" name="name" id="name" 
                    value="{{old('name', $dish_edit->name)}}">
            </div>
            @error('name')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione*</label>
                <textarea 
                    class="form-control" 
                    type="text" name="description" id="description" rows="6"
                >
                    {{ old('description', $dish_edit->description) }}
                </textarea>
            </div>
            @error('description')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo*</label>
                <input 
                class="form-control" type="text" name="price" id="price" 
                value = "{{old('price', $dish_edit->price)}}">
            </div>
            @error('price')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- ingredients --}}
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti*</label>
                <textarea class="form-control" name="ingredients" id="ingredients">
                    {{ old('ingredients', $dish_edit->ingredients) }}
                </textarea>
            </div>
            @error('ingredients')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- is_visible --}}
            <div class="mb-3">
                <h4>Visibilità</h4>
                <input type="checkbox" id="is_visible" name="is_visible" checked>
                <label for="is_visible">Visibile</label>
            </div>

            {{-- thumb --}}
            <div class="mb-3">
                <h4>Immagine del piatto</h4>
                @if ($dish_edit->thumb)
                    <figure class="mb-3">
                        <img src="{{ asset('./storage/' . $dish_edit->thumb)}}" alt="{{ $dish_edit->name}}">
                    </figure>
                @endif
                <input class="form-control-file " type="file" name="thumb" id="thumb">
            </div>
            @error('thumb')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- submit --}}
            <div>
                <button class="btn btn-primary" type="submit">
                   Salva modifiche
                </button>
            </div>
        </form>
    </div>
@endsection