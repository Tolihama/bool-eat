@extends('layouts.app')

@section('content')
    <div id="dishes-index" class="container p-4">
        <h1 class="pb-4">Il tuo menù</h1>

        {{-- Dish deleted message --}}
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                Piatto eliminato dal menù.
            </div>
        @endif
        
        {{-- No dishes case --}}
        @if ($dishes->isEmpty())
            <h2 class="h3">Non hai ancora piatti</h2>
            <a href="{{ route('admin.dishes.create') }}">Crea un nuovo piatto!</a>
        @else
            <div class="mb-3">
                <a href="{{ route('admin.dishes.create')}}" class="btn btn-success">Crea un nuovo piatto</a>
            </div>

            <div class="py-3">
                @foreach ($dishes as $dish)
                <div class="mb-3 dish-card d-flex">
                    <div class="thumb ml-2 mr-4">
                        <img src="{{ asset('/storage/' . $dish->thumb) }}" alt="Thumb {{ $dish->name }}">
                    </div>
                    <div class="dish-info d-flex flex-column">
                        <div>
                            <strong>{{ $dish->name }}</strong> ({{ $dish->price }} €)
                        </div>
                        <div>
                            @if ($dish->is_visible === 1)
                                <span class="text-success">
                                    <i class="fa-solid fa-eye mr-2"></i> Visibile
                                </span>
                            @else
                                <span class="text-danger">
                                    <i class="fa-solid fa-eye-slash mr-2"></i> Non visibile
                                </span>
                            @endif
                        </div>
                        <div>
                            {{ $dish->ingredients }}
                        </div>
                        <div class="flex-grow-1 py-3 d-flex align-items-end">
                            <a class="btn btn-primary mr-2" href="{{ route('admin.dishes.show', $dish->slug) }}">
                                <i class="fa-solid fa-eye"></i> Vai ai dettagli
                            </a>
                            <a class="btn btn-warning mr-2" href="{{ route('admin.dishes.edit', $dish->id) }}">
                                <i class="fa-solid fa-square-pen mr-2"></i> Modifica
                            </a>
                            <form action="{{ route('admin.dishes.destroy', $dish->id )}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-eraser mr-2"></i> Cancella
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection