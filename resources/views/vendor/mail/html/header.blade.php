<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="http://www.hdv.gov.co/files/biblioteca/2022-12-14_logoHDV1.png" class="logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
