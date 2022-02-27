@extends('layouts.app')

@section('content')
    <div class="container edit-restaurant py-4">

        @if ($errors->any()) 
            <div class="alert alert-danger">
                <ul class="py-0 my-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{route('admin.restaurant.update', $restaurant->slug)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="input mb-2">
                <label for="name">Nome ristorante</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name', $restaurant->name)}}">

                @error('name')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <label for="address">Indirizzo</label>
                <input type="text" name="address" id="address" class="form-control" value="{{old('address', $restaurant->address)}}">

                @error('address')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-4">
                <label for="vat">Partita IVA</label>
                <input type="text" name="vat" id="vat" class="form-control" value="{{old('vat', $restaurant->vat)}}">

                @error('vat')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2 d-flex align-items-center">
                <div class="input-img mb-2 mr-4">
                    <img src="{{asset('/storage/' . $restaurant->thumb)}}" alt="">
                </div>
                <div class="browse">
                    <label for="thumb" class="d-block">Immagine del profilo</label>
                    <input type="file" name="thumb" id="thumb">
                </div>

                @error('thumb')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2 d-flex align-items-center">
                <div class="input-img mb-2 mr-4">
                    <img src="{{asset('/storage/' . $restaurant->cover)}}" alt="">
                </div>
                <div class="browse">
                    <label for="cover" class="d-block">Immagine di copertina</label>
                    <input type="file" name="cover" id="cover">
                </div>

                @error('cover')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            


            @if ($categories)
                <div class="input mb-2">
                        <h4>Categorie</h4>
                        @foreach ($categories as $category)
                            <span class="d-inline-block form-check mr-3">
                                <input 
                                type="checkbox" 
                                id="category-{{$loop->iteration}}" 
                                name="categories[]" 
                                value="{{$category->id}}" 
                                @if($errors->any() && in_array($category->id, old('categories'))) 
                                checked 
                                @elseif(!$errors->any() && $restaurant->categories->contains($category->id))
                                checked
                                @endif>
                                
                                <label for="category-{{$loop->iteration}}">{{$category->name}}</label>
                        @endforeach

                        @error('category_id')
                        <div class="text-danger">{{$message}}</div>
                        @enderror

                </div>  
            @endif

            <button type="submit" class="btn btn-primary">Salva</button>






            

        </form>
    </div>
    
@endsection