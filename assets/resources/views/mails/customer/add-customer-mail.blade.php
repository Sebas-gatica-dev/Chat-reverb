@component('mail::message')

# Hola {{ $customer->name }},
Gracias por elegir {{ $customer->business->name }}.

@component('mail::panel')
Muy pronto recibiras más información de nuestra parte
@endcomponent

Saludos.

@endcomponent
