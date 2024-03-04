@if (has_field($page, 'external_links'))
    @php
        $external_links = collect(get_field($page, 'external_links'));
    @endphp
    @if (!empty($external_links))
    <section class="client-slider section_padding ">
        <div class="client-slide">
            <div class="quick-content container">
                <h2 class="quick-heading">Important Website Links</h2>
                <div class="swiper mySwiper" id="client-slider">
                    <div class="swiper-wrapper">
                        @foreach ($external_links as $item)
                        @php
                            $image = has_sub_field($item, 'image');
                            $title = has_sub_field($item, 'title');
                            $url = has_sub_field($item, 'url');
                        @endphp
                        <div class="swiper-slide ">
                            <div class="client-item">
                                <div class="item">
                                    <a href="{{$url ?? '#'}}" class="image" title="{{$title}}">
                                        <img src="{{ get_image_url($image) }}" class="img-fluid" alt="{{$title}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endif