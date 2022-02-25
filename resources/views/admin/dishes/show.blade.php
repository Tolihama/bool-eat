@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="mb-5">{{$dish->name}}</h1>

        <div class="row">
            
        </div>
            
        <div>
            <a class="btn btn-warinng" href="{{route('admin.dishes.edit', $dish->id) }} ">Edit</a>
            <a class="btn btn-primary" href="{{route('admin.dishes.index') }} ">Back to archive</a>
        </div>
    </div>
@endsection