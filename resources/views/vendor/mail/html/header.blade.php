@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images/Fondation-hassan-II-LOGO-01-300x73.png') }}" class="logo" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
