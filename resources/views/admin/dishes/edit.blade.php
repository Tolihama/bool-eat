@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="pb-4">Modifica: {{ $dish_edit->name }}</h1>

        @if ($errors->any()) 
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation text-danger fw-bold mr-2"></i> Attenzione: ci sono alcuni errori di compilazione!
            </div>
        @endif

        <form action="{{route('admin.dishes.update', $dish_edit->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome piatto*</label>
                <input class="form-control" type="text" name="name" id="name" value="{{old('name', $dish_edit->name)}}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo*</label>
                <input class="form-control" type="number" step="0.01" min="0" max="999.99" name="price" id="price" value="{{old('price', $dish_edit->price)}}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione*</label>
                <textarea 
                    class="form-control" 
                    type="text" name="description" id="description" rows="6"
                >{{ old('description', $dish_edit->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- ingredients --}}
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti*</label>
                <textarea class="form-control" name="ingredients" id="ingredients">{{ old('ingredients', $dish_edit->ingredients) }}</textarea>
            </div>
            @error('ingredients')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- is_visible --}}
            <div class="mb-3">
                <h4>Visibilità</h4>
                <input type="checkbox" id="is_visible" name="is_visible" @if($dish_edit->is_visible === 1) checked @endif>
                <label for="is_visible">Visibile</label>
            </div>

            {{-- thumb --}}
            <div class="mb-3">
                <h4>Immagine del piatto</h4>
                @if ($dish_edit->thumb)
                    <figure class="mb-3">
                        <img class="w-100" src="{{ asset('./storage/' . $dish_edit->thumb)}}" alt="{{ $dish_edit->name}}">
                    </figure>
                @endif
                <input class="form-control-file " type="file" name="thumb" id="thumb">
                @error('thumb')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- submit --}}
            <div>
                <button class="btn btn-primary" type="submit">
                   Salva modifiche
                </button>
            </div>
        </form>
    </div>
@endsection