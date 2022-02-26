@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Crea il tuo ristorante</h1>
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any()) 
            <div class="alert alert-danger">
                <ul class="py-0 my-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.restaurant.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input mb-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">

                @error('name')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}">

                @error('address')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <label for="vat">Vat number</label>
                <input type="text" name="vat" id="vat" class="form-control" value="{{old('vat')}}">

                @error('vat')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <label for="thumb">Thumb</label>
                <div class="browse">
                    <input type="file" name="thumb" id="thumb">
                </div>

                @error('thumb')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <label for="cover">Cover</label>
                <div class="browse">
                    <input type="file" name="cover" id="cover">
                </div>

                @error('cover')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>


            @if ($categories)
                <div class="input mb-2">
                        @foreach ($categories as $category)
                            <span class="d-inline-block form-check mr-3">
                                <input 
                                type="checkbox" 
                                id="category{{$loop->iteration}}" 
                                name="categories[]" 
                                value="{{$category->id}}" 
                                @if(in_array($category->id, old('categories', []))) checked @endif>
                                
                                <label for="category{{$loop->iteration}}">{{$category->name}}</label>
                        @endforeach

                        @error('category_id')
                        <div class="text-danger">{{$message}}</div>
                        @enderror

                </div>  
            @endif

            <button type="submit" class="btn btn-primary">Save</button>






            

        </form>
    </div>
    
@endsection