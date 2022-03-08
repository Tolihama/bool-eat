@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ordrs Index ok</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order )
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name}}</td>
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
    </div>
@endsection