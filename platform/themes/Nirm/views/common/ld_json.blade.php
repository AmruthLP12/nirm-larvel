@if ($page)
    @php
        $ld_json = \MetaBox::getMetaData($page, 'json_ld', true);
        $ld_json = str_replace([
            '{{URL::current()}}',
            '{{logo}}'
        ],[
            URL::current(),
            RvMedia::getImageUrl(theme_option('logo'))
        ], $ld_json);
    @endphp
    <script type="application/ld+json">
        {!! $ld_json !!}
    </script>
@endif