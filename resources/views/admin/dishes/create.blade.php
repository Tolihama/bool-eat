@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-5">Create a new dishes</h1>

        <form action="{{route('admin.dishes.store')}}" method="POST" encrypted="multiple/from-data">
            @csrf

            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name*</label>
                <input class="form-control" type="text" name="name" id="name" value{{old('name')}}>
            </div>
            @error('name')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- description --}}
            <div class="mb-3">
                <label for="description" class="form-label">description*</label>
                <textarea class="form-control" type="text" name="description" id="description">
                    {{ old('description') }}</textarea>
                </textarea>
            </div>
            @error('description')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- price --}}
            <div class="mb-3">
                <label for="price" class="form-label">price*</label>
                <input class="form-control" type="text" name="price" id="price" value{{old('price')}}>
            </div>
            @error('price')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- ingredients --}}
            <div class="mb-3">
                <label for="ingredients" class="form-label">ingredients*</label>
                <textarea class="form-control" name="ingredients" id="ingredients">{{ old('ingredients') }}</textarea>
            </div>
            @error('ingredients')
                 <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- is_visible --}}
            <div class="mb-3">
                <h4>visibility</h4>
                <input type="checkbox" id="is_visible" name="is_visible" checked>
                <label for="is_visible">Visible</label>
            </div>

            {{-- thumb --}}
            <div class="mb-3">
                <h4>Immagine Dishes</h4>
                <input class="form-control-file" type="file" name="thumb" id="thumb">
            </div>
            @error('thumb')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- submit --}}
            <div>
                <button class="btn btn-primary" type="submit">
                    Create dish
                </button>
            </div>
        </form>
    </div>
@endsection