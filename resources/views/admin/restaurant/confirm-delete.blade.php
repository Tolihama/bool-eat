@extends('layouts.app')

@section('content')
    <div id="restaurant-confirm-delete" class="container py-5">
        <div class="card bg-warning">
            <div class="card-header">
                <h1 class="m-0">Conferma l'eliminazione del tuo ristorante</h1>
            </div>
            <div class="card-body">
                <div class="alert alert-danger">
                    <i class="fa-solid fa-triangle-exclamation text-danger fw-bold mr-2"></i> Attenzione: l'operazione non è reversibile!
                </div>
                <p>Procedendo con questa conferma, eliminerai definitivamente la registrazione del tuo ristorante sulla nostra piattaforma: dati del ristorante, il menù e lo storico degli ordini saranno cancellati e non saranno recuperabili.</p>
                <p>Per confermare la cancellazione, scrivi <strong>{{ $restaurant->slug }}</strong> nel campo di testo sottostante, dopodiché esegui la conferma.</p>
                <form action="{{ route('admin.restaurant.destroy', $restaurant->slug) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <input 
                            type="text"
                            id="confirm" 
                            name="confirm"
                            class="form-control w-50 mr-3" 
                            pattern="{{ $restaurant->slug }}"
                        >
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-eraser mr-2"></i> Conferma eliminazione del ristorante
                        </button>
                    </div>
                    @error('confirm')
                        <div class="text-danger text-center">Errore: {{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>


    </div>
@endsection