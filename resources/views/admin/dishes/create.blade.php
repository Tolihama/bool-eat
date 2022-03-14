@extends('layouts.app')

@section('content')
    <div id="dishes-create" class="container py-4">
        <h1 class="pb-4">Crea un nuovo piatto</h1>

        @if ($errors->any()) 
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation text-danger fw-bold mr-2"></i> Attenzione: ci sono alcuni errori di compilazione!
            </div>
        @endif

        <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome piatto*</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" required maxlength="50">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo*</label>
                <input class="form-control" type="number" step="0.01" min="0" max="999.99" name="price" id="price" required value="{{ old('price') }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione*</label>
                <textarea class="form-control" type="text" name="description" id="description" required >{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- ingredients --}}
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti*</label>
                <textarea class="form-control" name="ingredients" id="ingredients" required >{{ old('ingredients') }}</textarea>
                @error('ingredients')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- is_visible --}}
            <div class="mb-3">
                <h4>Visibilità</h4>
                <input type="checkbox" id="is_visible" name="is_visible" checked>
                <label for="is_visible">Visibile</label>
            </div>

            {{-- thumb --}}
            <div class="mb-3">
                <h4>Immagine del piatto</h4>
                <input class="form-control-file" type="file" name="thumb" id="thumb" required 
                accept=".png, .jpeg, .jpg, .bmp">
                @error('thumb')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- submit --}}
            <div>
                <button class="btn btn-primary" type="submit">
                    Crea piatto
                </button>
            </div>
        </form>
    </div>
@endsection