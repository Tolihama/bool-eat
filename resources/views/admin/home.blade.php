@extends('layouts.app')

@section('content')
<div id="dashboard" class="container py-5">
    <h1>Dashboard di {{ Auth::user()->name }}</h1>

    <div class="row align-items-stretch py-3">
        <div class="col-sm-12 col-lg-6 p-3">
            <div class="card d-flex flex-column h-100 restaurant-info @if (!$user_restaurant) bg-warning @endif">
                <h2>
                    Il tuo ristorante 
                    @if (!$user_restaurant) <i class="fa-solid fa-triangle-exclamation text-danger ml-2"></i> 
                    @else <i class="fa-solid fa-circle-check text-success ml-2"></i> 
                    @endif
                </h2>
                <div class="flex-grow-1 d-flex flex-column justify-content-center">
                    @if ($user_restaurant)
                    <p class="text-success">
                        Ristorante correttamente registrato!
                    </p>
                    <div class="row mb-4 px-3">
                        <div class="col-sm-6 p-0">
                            <div class="thumb mx-auto">
                                <img src=" @if(preg_match('/http/', $user_restaurant->thumb) ) {{$user_restaurant->thumb}} @else{{ asset('/storage/' . $user_restaurant->thumb) }} @endif" alt="Thumb {{ $user_restaurant->name }}" class="w-100">
                            </div>
                        </div>
                        <div class="col-sm-6 p-0 py-3 mx-auto text-sm-left text-center">
                            <ul>
                                <li>Nome: {{ $user_restaurant->name }}</li>
                                <li>Indirizzo: {{ $user_restaurant->address }}</li>
                                <li>P. Iva: {{ $user_restaurant->vat }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('admin.restaurant.index') }}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-info mr-2"></i> Riepilogo
                        </a>
                        <a href="{{ route('admin.restaurant.edit', $user_restaurant->slug) }}" class="btn btn-warning">
                            <i class="fa-solid fa-square-pen mr-2"></i> Modifica
                        </a>
                    </div>
                    @else
                        <p>
                            Non hai ancora registrato il tuo ristorante!<br>
                            <a href="{{ route('admin.restaurant.create') }}">Registralo adesso!</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-6 p-3">
            <div class="card d-flex flex-column h-100
                @if (!$user_restaurant) bg-danger 
                @elseif ($dishes->count() === 0) bg-warning
                @endif
            ">
                <h2>
                    Il tuo menù 
                    @if (!$user_restaurant) <i class="fa-solid fa-circle-xmark ml-2"></i> 
                    @elseif($dishes->count() === 0) <i class="fa-solid fa-triangle-exclamation text-danger ml-2"></i>
                    @else <i class="fa-solid fa-circle-check text-success ml-2"></i>
                    @endif
                </h2>
                <div class="flex-grow-1 d-flex flex-column">
                    @if (!$user_restaurant) 
                        <p>Non puoi aggiungere piatti al tuo menù se prima non registri il tuo ristorante!</p>
                    @elseif ($dishes->count() === 0)
                        <p>
                            <strong>Il menù non ha piatti.</strong><br>
                            <a href="{{ route('admin.dishes.create') }}">Crea il tuo primo piatto!</a>
                        </p>
                    @else
                        <p>Piatti presenti nel menù: {{ $dishes->count() }}</p>
                        <ul>
                            @foreach ($dishes_paginate as $dish)
                                <li>
                                    <a href="{{ route('admin.dishes.show', $dish->slug) }}">{{ $dish->name }}</a> ({{ $dish->price }} €)
                                </li>
                            @endforeach
                        </ul>
                        <p>{{ $dishes_paginate->links() }}</p>
                        <div class="flex-grow-1 d-flex justify-content-center align-items-end">
                            <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">Vai al menù</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-6 p-3">
            <div class="card d-flex flex-column h-100">
                <h2>I tuoi ordini</h2>
                <div class="flex-grow-1">
                    @if (count($orders) === 0) 
                    <p>Non ci sono ordini in archivio</p>
                    @else
                    <ul>
                        @foreach ( $orders as $order )
                            <li>
                                <a href="{{ route('admin.orders.show', $order->id)}}">Ordine N.{{ $order->id}}</a> da {{ $order->customer_name}}
                            </li>
                        @endforeach
                    </ul>
                    <p>{{ $orders->links() }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-6 p-3 d-none">
            <div class="card d-flex flex-column bg-danger h-100">
                <h2>Il tuo profilo <i class="fa-solid fa-circle-xmark ml-2"></i></h2>
                <div class="flex-grow-1">
                    Feature da implementare
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
