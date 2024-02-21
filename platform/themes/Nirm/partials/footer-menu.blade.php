<ul {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <li class="footer-menu-li {{ $row->css_class }} @if ($row->url == Request::url()) current @endif">
            <a href="{{ $row->url }}" target="{{ $row->target }}" class="menu-item">
                {{ $row->name }}
            </a>
        </li>
    @endforeach
</ul>