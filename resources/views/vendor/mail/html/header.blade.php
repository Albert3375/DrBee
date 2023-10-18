<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/zoofish-pets.png') }}" style="width: auto !important; height: auto !important; max-width: 75%;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
