@component('mail::message')
# Hai ricevuto un nuovo ordine!
 
**Transaction ID:** {{ $transaction_id }}
 
{{-- @component('mail::button', ['url' => {{ route('/') }}])
Vai a vedere il nuovo ordine
@endcomponent --}}
 
Grazie,<br>
{{ config('app.name') }}
@endcomponent