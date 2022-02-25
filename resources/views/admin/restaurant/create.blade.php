@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <form action="{{route('admin.restaurant.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input mb-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">

                @error('name')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">

                @error('address')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="input mb-2">
                <label for="vat">Vat number</label>
                <input type="text" name="vat" id="vat" class="form-control">

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
                            <label for="{{$category->id}}">{{$category->name}}</label>
                            <input 
                                type="checkbox" 
                                id="{{$category->id}}" 
                                name="{{$category->name}}" 
                                value="{{$category->id}}" 
                                @if ($category->id == old('category_id')) selected @endif
                                >
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