<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Mamaz')
    @foreach( $site_settings as $value )
        <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitelogodark) }}" alt="Mamaz" class="img-fluid">
    @endforeach
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
