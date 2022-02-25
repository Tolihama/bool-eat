@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h1 class="text-center">Dishes archive</h1>

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
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.dishes.create')}}">Create</a>
                        </td>
        
                        <td>
                            <a class="btn btn-primary" href="#">Edit</a>
                        </td>
        
                        <td>
                            <a class="btn btn-primary" href="#">show</a>
                        </td>
        
                        <td>
                            <form action="" method="POST">
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