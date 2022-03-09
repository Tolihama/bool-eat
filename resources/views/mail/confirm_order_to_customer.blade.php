@component('mail::message')
# Grazie per aver fatto il tuo ordine su Bool Eat!

## Abbiamo registrato il tuo ordine fatto a {{ $restaurant_name }}.

**Transaction ID:** {{ $transaction_id }}
 
Grazie,<br>
{{ config('app.name') }}
@endcomponent
