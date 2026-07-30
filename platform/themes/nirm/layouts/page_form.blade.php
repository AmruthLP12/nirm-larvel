{!! Theme::partial('header') !!}

    <div id="preloader"></div>
    <div class="body-inner">
        {!! Theme::partial('top_bar') !!}
        {!! Theme::partial('menu_header') !!}

        {!! Theme::partial('breadcrumbs') !!}
        @php
            $page = Theme::get('page');
        @endphp
        @if ($page)
            {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, ($page->content), $page) !!}
            @php
                $other_content = \MetaBox::getMetaData($page, 'other_content', true);
            @endphp
            {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, ($other_content), $page) !!}
        @else
            {!! Theme::content() !!}
        @endif

        @include('theme.'.Theme::getThemeName().'::views.custom-fields.faqs')
        @include('theme.'.Theme::getThemeName().'::views.custom-fields.call-us')
    </div>

@include('theme.'.Theme::getThemeName().'::views.common.ld_json', ['page' => $page])
{!! Theme::partial('footer') !!}
