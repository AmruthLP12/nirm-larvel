@foreach($supportedLocales as $localeCode => $properties)
    @php
        $url = url()->full();
    @endphp
    <link rel="alternate" href="{{ Language::getLocalizedURL($localeCode, $url) }}" hreflang="{{ $localeCode }}" />
@endforeach
