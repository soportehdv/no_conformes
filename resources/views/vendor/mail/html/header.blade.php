<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/' . 'logoHDV1.png') }}" class="logo" alt="Laravel Logo" width="400" height="200">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
