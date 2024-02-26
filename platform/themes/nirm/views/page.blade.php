@php
    Theme::set('page', $page);
@endphp
{!! Theme::partial('breadcrumbs') !!}

{!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, clean($page->content), $page) !!}
