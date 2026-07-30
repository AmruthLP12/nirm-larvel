@if (theme_option('favicon'))
    <link rel="shortcut icon" href="{{ RvMedia::getImageUrl(theme_option('favicon')) }}">
@endif
@php
    /**
     * custom tag
     */
    $pageNumber = request()->get('page');
    if (!empty($pageNumber)) {
        $title = SeoHelper::getTitle();
        SeoHelper::setTitle("$title - Page $pageNumber");

        $description = SeoHelper::getDescription();
        $description = empty($description) ? "Page $pageNumber" : $description . " - Page $pageNumber";
        SeoHelper::setDescription($description);
    }
@endphp
{!! SeoHelper::render() !!}

{!! Theme::asset()->styles() !!}
{!! Theme::asset()->container('after_header')->styles() !!}
{!! Theme::asset()->container('header')->scripts() !!}

{!! apply_filters(THEME_FRONT_HEADER, null) !!}
