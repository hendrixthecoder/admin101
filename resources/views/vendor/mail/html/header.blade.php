<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img class="mx-auto mw-100" src="{{ $message->embed(asset('/images/logo.png')) }}" alt="No Logo">
<img src="{{ public_path('storage/images/logo.png') }}" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
