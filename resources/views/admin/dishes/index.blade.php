@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h1 class="text-center">Dishes archive</h1>

        {{-- delete --}}
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('delete') }}</strong>
                delete successfully.
            </div>
            
        @endif

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
                        <td>{{ $dish->id }}</td>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->price }} $</td>
        
                        <td>
                            <a class="btn btn-primary" href="#">Edit</a>
                        </td>
        
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.dishes.show', $dish->slug) }}">show</a>
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

    </div>
@endsection