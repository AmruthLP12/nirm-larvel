{!! Theme::partial('header') !!}
<main>
    @php
        $page = Theme::get('page');
    @endphp
    @if (function_exists('get_sliders'))
        @php $sliders = get_sliders(); $id = rand(1000, 9999); @endphp
        @if (!$sliders->isEmpty())
        <section class="main-slider">
            <div class="home-slider">
                <div class="swiper mySwiper" id="main-slider">
                    <div class="swiper-wrapper">
                        @foreach ($sliders as $item)
                        <div class="swiper-slide">
                            <img src="{{RvMedia::getImageUrl($item->image ?? null)}}" class="img-fluid" alt="{!! $item->title !!}">
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        @endif
    @endif
    @if ($page)
        {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, ($page->content), $page) !!}
    @else
        {!! Theme::content() !!}
    @endif
    @include('theme.'.Theme::getThemeName().'::views.custom-fields.quick_links')
    @include('theme.'.Theme::getThemeName().'::views.custom-fields.external_links')
    @include('theme.'.Theme::getThemeName().'::views.custom-fields.galleries')

    @php
        $other_content = \MetaBox::getMetaData($page, 'other_content', true);
    @endphp
    {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, ($other_content), $page) !!}
</main>

@include('theme.'.Theme::getThemeName().'::views.common.ld_json', ['page' => $page])

{!! Theme::partial('footer') !!}
