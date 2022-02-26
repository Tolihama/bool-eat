@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="card w-100">
            <div class="card-header text-center">
                <h2 class="mb-0">Benvenuto su Bool Eat, {{ Auth::user()->name }}!</h2>
            </div>
            <div class="card-body text-center">
                <a href="{{ url('/') }}" class="btn btn-success">Torna sul sito</a>
                <a href="{{ route('admin.home')}}" class="btn btn-primary">Vai alla tua dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection