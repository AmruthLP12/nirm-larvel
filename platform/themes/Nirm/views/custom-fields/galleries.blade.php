@if (has_field($page, 'galleries'))
    @php
        $galleries = collect(get_field($page, 'galleries'));
    @endphp
    @if (!empty($galleries))
    <section class="image-content section_padding">
        <div class="image-gallery">
            <div class="container">
                <div class="gallery-container">
                    <div class="swiper-container gallery-main">
                        <div class="swiper-wrapper">
                            @foreach ($galleries as $item)
                            @php
                                $image = has_sub_field($item, 'image');
                                $title = has_sub_field($item, 'title');
                            @endphp
                            <div class="swiper-slide">
                                <img src="{{ get_image_url($image) }}" alt="{{$title}}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            @foreach ($galleries as $item)
                            @php
                                $image = has_sub_field($item, 'image');
                                $title = has_sub_field($item, 'title');
                            @endphp
                            <div class="swiper-slide">
                                <img src="{{ get_image_url($image) }}" alt="{{$title}}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endif