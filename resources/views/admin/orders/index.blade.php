@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Ordrs Index ok</h1>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2">Actions</th>
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