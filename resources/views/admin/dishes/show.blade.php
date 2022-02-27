@extends('layouts.app')

@section('content')
    <div id="show-dish" class="container p-4">
        <h1 class="mb-5">{{ $dish->name }}</h1>

        <div class="row">
            <div class="col-sm-12 col-md-6 px-4">
                <img src="{{ asset('./storage/' . $dish->thumb)}}" alt="{{ $dish->name }}">
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="mb-3 dish-detail">
                    <h4>Informazioni</h4>
                    <ul class="p-0 m-0">
                        <li>
                            Prezzo: {{ $dish->price }} €
                        </li>
                        <li>
                            @if ($dish->is_visible === 1)
                                <span class="text-success">
                                    <i class="fa-solid fa-eye mr-2"></i> Visibile
                                </span>
                            @else
                                <span class="text-danger">
                                    <i class="fa-solid fa-eye-slash mr-2"></i> Non visibile
                                </span>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="mb-3">
                    <h4>Ingredienti</h4>
                    <p>{{ $dish->ingredients }}</p>
                </div>
                <div class="mb-3">
                    <h4>Descrizione</h4>
                    <p>{{ $dish->description }}</p>
                </div>
            </div>
        </div>
            
        <div class="mt-4">
            <a class="btn btn-warning mr-4" href="{{route('admin.dishes.edit', $dish->id) }} "><i class="fa-solid fa-square-pen mr-2"></i> Modifica piatto</a>
            <a class="btn btn-primary " href="{{route('admin.dishes.index') }} ">Torna al menù</a>
        </div>
    </div>
@endsection