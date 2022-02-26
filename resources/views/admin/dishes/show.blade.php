@extends('layouts.app')

@section('content')
    <div class="container show-dish mt-3">
        <h1 class="mb-5">{{$dish->name}}</h1>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('./storage/' . $dish->thumb)}}" alt="{{ $dish->name }}">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-3">
                <h4>Ingredients</h4>
                <p>{{ $dish->ingredients }}</p>
            </div>
            <div class="mb-3 col-md-6">
                <h4>Description</h4>
                <p>{{ $dish->description }}</p>
            </div>
        </div>
            
        <div>
            <a class="btn btn-warning" href="{{route('admin.dishes.edit', $dish->id) }} ">Edit Dish</a>
            <a class="btn btn-primary" href="{{route('admin.dishes.index') }} ">Back to archive</a>
        </div>
    </div>
@endsection