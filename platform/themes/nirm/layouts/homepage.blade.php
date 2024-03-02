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
                            <img src="{{RvMedia::getImageUrl($item->image ?? null)}}" class="img-fluid" alt="{{$item->title}}">
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
    @if (function_exists('get_posts_by_category_name'))
        @php
            $information_sections = get_posts_by_category_name();
        @endphp
        @if (!empty($information_sections))
        <section class="information-content section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    @foreach ($information_sections as $item)
                    <div class="col-lg-4 col-12 info-box">
                        <div class="info border_radias_5px">
                            <div class="info-wrap">
                                <div>
                                    <h4>
                                        {{ $item['category']->name }}
                                    </h4>
                                </div>
                                <div class="info-footer">
                                    <a class="read-btn border_radias_5px" href="{{ $item['category']->url }}" title="Read More">Read More &gt;&nbsp;</a>
                                </div>
                            </div>
                            <div class="info-box-wrapper">
                                <div class="marquee">
                                    <div class="info-contant">
                                        @php
                                            $posts = $item['posts'];
                                        @endphp
                                        <ul>
                                            @foreach ($posts as $post)
                                                <li class="news1">
                                                    <a href="{{ $post->url }}">{{ $post->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
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
