@extends('layouts.app')

@section('content')
    <div id="container-order" class="container py-5">
        <h1 class="text-center pb-3">Dettagli dell'ordine: 
            <strong> {{ $order->customer_name}}</strong>
       </h1>
        <div class="row info-order-ctn py-4">
            <div class=" px-4 col-12 col-md-6 cart-ctn d-flex flex-column">
                <h3 class = "py-3 text-center text-uppercase">Riferimenti cliente</h3>
                <ul class="box-info flex-grow-1">
                    <li>
                        ID dell'ordine: 
                        <a href="#">{{ $order->id }}</a>
                    </li>
                    <li>
                        Nome del cliente: 
                        <br />
                        <a href="#">{{ $order->customer_name}}</a>
                    </li>
                    <li>
                        Indirizzo di consegna: 
                        <br />
                        <a href="#">
                            {{$order->customer_address }}
                        </a>
                    </li>
                    <li>
                        Numero di telefono: 
                        <br />
                        <a href="#">
                            {{ $order->customer_phone}}
                        </a>
                    </li>
                    <li>
                        Email del cliente: 
                        <br />
                        <a href="#">
                            {{ $order->customer_email}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class=" px-4 col-12 col-md-6 cart-ctn d-flex flex-column">
                <h3 class="py-3 text-center text-uppercase">Articoli</h3>
                <ul class="box-info flex-grow-1">
                    @foreach ($dishes as $dish )
                        <li>
                            <a href="{{ route('admin.dishes.show', $dish->slug)}}">{{ $dish->name }}</a> - {{ $dish->quantity }} porzioni. 
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-12 px-4">
                <div class="btn-ctn mt-3">
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