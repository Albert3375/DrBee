@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="https://zoofish.com.mx/wp-content/uploads/2021/08/zoofish-pets.png" style="width: auto !important; height: auto !important; max-width: 75%;">
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Zoofish. @lang('Todos los derechos reservados.')
@endcomponent
@endslot
@endcomponent
