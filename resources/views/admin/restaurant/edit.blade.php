@extends('layouts.app')

@section('content')
    <div id="edit-restaurant" class="container py-4">
        <h1 class="pb-4">Modifica il tuo ristorante: {{ $restaurant->name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation text-danger fw-bold mr-2"></i> Attenzione: ci sono alcuni errori
                di compilazione!
            </div>
        @endif

        <form action="{{ route('admin.restaurant.update', $restaurant->slug) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="input mb-2">
                <label for="name">Nome ristorante</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $restaurant->name) }}" required maxlength="100">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <label for="address">Indirizzo</label>
                <input type="text" name="address" id="address" class="form-control"
                    value="{{ old('address', $restaurant->address) }}" required maxlength="150">

                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="input mb-4">
                <label for="vat">Partita IVA</label>
                <input type="text" name="vat" id="vat" class="form-control" value="{{ old('vat', $restaurant->vat) }}"
                    minlength="11" maxlength="11" required>

                @error('vat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="input mb-2 d-flex align-items-center">
                <div class="input-img mb-2 mr-4">
                    <img src="{{ asset('/storage/' . $restaurant->thumb) }}" alt="">
                </div>
                <div class="browse">
                    <label for="thumb" class="d-block">Immagine del profilo</label>
                    <input type="file" name="thumb" id="thumb" accept=".jpeg,.jpg,.bmp,.png">
                </div>

                @error('thumb')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="input mb-2 d-flex align-items-center">
                <div class="input-img mb-2 mr-4">
                    <img src="{{ asset('/storage/' . $restaurant->cover) }}" alt="">
                </div>
                <div class="browse">
                    <label for="cover" class="d-block">Immagine di copertina</label>
                    <input type="file" name="cover" id="cover" accept=".jpeg,.jpg,.bmp,.png">
                </div>

                @error('cover')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <h4>Categorie</h4>
                @foreach ($categories as $category)
                    <span class="d-inline-block form-check mr-3">
                        <input type="checkbox" id="category-{{ $loop->iteration }}" name="categories[]"
                            value="{{ $category->id }}" class="checkbox-group"
                            @if ($errors->any() && in_array($category->id, old('categories'))) checked 
                            @elseif(!$errors->any() && $restaurant->categories->contains($category->id))
                            checked @endif
                            onclick='ValidationGroup("checkbox-group")'>

                        <label for="category-{{ $loop->iteration }}">{{ $category->name }}</label>
                @endforeach

                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salva</button>

        </form>
    </div>
@endsection
