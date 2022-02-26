@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h1 class="text-center">Dishes archive</h1>

        <div class="mb-3 row justify-content-end mr-3">
            <a href="{{ route('admin.dishes.create')}}" class="btn btn-success end">Create a new dish</a>
        </div>

        {{-- delete --}}
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('delete') }}</strong>
                delete successfully.
            </div>

        @endif

        @if ($dishes->isEmpty())
            <h2>Non hai ancora piatti</h2>
            <a class="btn btn-success" href="{{ route('admin.dishes.create') }}">Creane uno</a>
        @else

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th colspan="4"> Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dishes as $dish)
                    <tr>
                        {{-- <td>{{ $dish->id }}</td> --}}
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->price }} $</td>
        
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.dishes.edit', $dish->id) }}">Edit</a>
                        </td>
        
                        <td>
                            <a class="btn btn-info" href="{{ route('admin.dishes.show', $dish->slug) }}">show</a>
                        </td>
        
                        <td>
                            <form action="{{ route('admin.dishes.destroy', $dish->id )}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection