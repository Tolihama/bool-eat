@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-5">Create a new dishes</h1>

        <form action="" method="POST" encrypted="multiple/from-data">
            @csrf

            {{-- name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name*</label>
                <input class="form-control" type="text" name="name" id="name" value{{old('name')}}>
            </div>

            {{-- name --}}
            <div class="mb-3">
                <label for="description" class="form-label">description*</label>
                <input class="form-control" type="text" name="description" id="description" value{{old('description')}}>
            </div>

            {{-- name --}}
            <div class="mb-3">
                <label for="price" class="form-label">price*</label>
                <input class="form-control" type="text" name="price" id="price" value{{old('price')}}>
            </div>
        </form>
    </div>
@endsection