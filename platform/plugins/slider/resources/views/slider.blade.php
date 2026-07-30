@if (function_exists('get_sliders'))
    @php $sliders = get_sliders($limit); $id = rand(1000, 9999); @endphp
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