@extends('layouts.app')

@section('content')
    <div id="container-order" class="container py-5">
        <h1 class="text-center">Dettagli dell'ordine: 
            <strong> {{ $order->customer_name}}</strong>
       </h1>
        <div class="row">
            <div class="mt-5 info-order-ctn">
                <h3 class = "mb-3">Informazioni:</h3>
                <div class="box-info">
                    <p>
                        ID dell'ordine: 
                        <a href="#">{{ $order->id }}</a>
                    </p>
                </div>
    
                <div class="box-info">
                    <p>
                        Nome del cliente: 
                        <a href="#">{{ $order->customer_name}}</a>
                    </p>
                </div>
    
                <div class="box-info">
                    <p>
                        Indirizzo di consegna: 
                        <a href="#">
                            {{$order->customer_address }}
                        </a>
                    </p>
                </div>
    
                <div class="box-info">
                    <p>
                        Numero di telefono del clienete: 
                        <a href="#">
                            {{ $order->customer_phone}}
                        </a>
                    </p>
                </div>
    
                <div class="box-info">
                    <p>
                        Email del cliente: 
                        <a href="#">
                            {{ $order->customer_email}}
                        </a>
                    </p>
                </div>
    
                <div class="btn-ctn px-3 mt-3">
                    <a href="{{ route('admin.orders.index') }}" 
                        class="btn-order-info effect01">
                        <span>
                            torna indietro
                        </span>
                    </a>
    
                    <a href="{{ route('admin.home') }}" 
                        class="btn-order-info effect01">
                        <span>
                              Dashboard
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection