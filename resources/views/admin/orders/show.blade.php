@extends('layouts.app');

@section('content')
    <div class="container mt-5 ml-3">
         <h1 class="text-center">Dettagli dell'ordine: 
             <strong> {{ $order->customer_name}}</strong>
        </h1>
        <div class="mt-3 px-3 info-order-ctn">
            <h3>Informazioni:</h3>
            <p class="tm-3">
                ID dell'ordine: 
                <a href="#">{{ $order->id }}</a>
            </p>

            <p>
                Nome del cliente: 
                <a href="#">{{ $order->customer_name}}</a>
            </p>

            <p>
                Indirizzo di consegna: 
                <a href="#">
                    {{$order->customer_address }}
                </a>
            </p>

            <p>
                Numero di telefono del clienete: 
                <a href="#">
                    {{ $order->customer_phone}}
                </a>
            </p>

            <p>
                Email del cliente: 
                <a href="#">
                    {{ $order->customer_email}}
                </a>
            </p>
        </div>
    </div>
@endsection