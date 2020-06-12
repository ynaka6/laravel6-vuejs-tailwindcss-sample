<tr>
<td class="header">
<a href="{{ $url }}">
@if (App::environment(['local', 'testing']))
{{ $slot }}
@else
<img src="{{ asset('img/header-logo.png') }}" alt="{{ $slot }}">
@endif
</a>
</td>
</tr>
