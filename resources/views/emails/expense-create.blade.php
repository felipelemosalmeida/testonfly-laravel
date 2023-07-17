@component('mail::message')
# Detalhes da Despesa

**Descrição:** {{$expense->description}} <br/>
**Data:** {{$expense->date->format('d/m/Y')}} <br/>
**Valor:** R${{ number_format($expense->price, 2, ',', '.') }}

{{ config('app.name') }}
@endcomponent
