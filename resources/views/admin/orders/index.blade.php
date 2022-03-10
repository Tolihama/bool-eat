@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Archivio ordini</h1>
        {{ $orders->links() }}
        @if ($orders->isEmpty()) 
        <p>Non ci sono ordini in archivio</p>
        @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nome Cliente</th>
                    <th>Indirizzo</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Data</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order )
                    <tr>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_address }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>{{ $order->customer_phone }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a class="btn btn-primary" 
                                href="{{route('admin.orders.show', $order->id)}}">
                                Guarda in dettaglio
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection