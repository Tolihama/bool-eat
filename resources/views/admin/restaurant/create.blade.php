@extends('layouts.app')

@section('content')
    <div id="restaurant-create" class="container py-4">
        <h1 class="pb-4">Crea il tuo ristorante</h1>
        @if (session('status'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation text-danger fw-bold mr-2"></i> {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation text-danger fw-bold mr-2"></i> Attenzione: ci sono alcuni errori
                di compilazione!
            </div>
        @endif
        <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <h4 class="mb-2">Riferimenti</h4>

                <div class="input row align-items-center mb-3">
                    <label for="name" class="col-2">Nome del ristorante:</label>
                    <input type="text" name="name" id="name" class="form-control col-10" value="{{ old('name') }}"
                        required maxlength="100">

                    @error('name')
                        <div class="text-danger col-12">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input row align-items-center mb-3">
                    <label for="address" class="col-2">Indirizzo:</label>
                    <input type="text" name="address" id="address" class="form-control col-10"
                        value="{{ old('address') }}" required maxlength="150">

                    @error('address')
                        <div class="text-danger col-12">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input row align-items-center mb-3">
                    <label for="vat" class="col-2">Partita IVA:</label>
                    <input type="text" name="vat" id="vat" class="form-control col-10" value="{{ old('vat') }}"
                        minlength="11" maxlength="11" required>

                    @error('vat')
                        <div class="text-danger col-12">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <h4>Immagini</h4>
                <div class="row">
                    <div class="col-sm-12 col-md-6 input mb-2">
                        <label for="thumb">Immagine del profilo:</label>
                        <div class="browse mb-2">
                            <input type="file" name="thumb" id="thumb" accept=".jpeg,.jpg,.bmp,.png" required>
                        </div>

                        @error('thumb')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-6 input mb-2">
                        <label for="cover">Immagine di copertina:</label>
                        <div class="browse mb-2">
                            <input type="file" name="cover" id="cover" accept=".jpeg,.jpg,.bmp,.png" required>
                        </div>

                        @error('cover')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h4>Categorie</h4>
                <div class="row">
                    @foreach ($categories as $category)
                        <span class="form-check mr-2">
                            <input type="checkbox" id="category{{ $loop->iteration }}" class="checkbox-group"
                                name="categories[]" value="{{ $category->id }}"
                                @if (in_array($category->id, old('categories', []))) checked @endif onclick='ValidationGroup("checkbox-group")'
                                required>

                            <label for="category{{ $loop->iteration }}">{{ $category->name }}</label>
                        </span>
                    @endforeach
                </div>

                @error('categories')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Registra il tuo ristorante!</button>
        </form>
    </div>
@endsection
