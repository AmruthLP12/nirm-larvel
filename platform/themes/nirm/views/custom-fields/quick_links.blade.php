@if (has_field($page, 'quick_links'))
    @php
        $quick_links = collect(get_field($page, 'quick_links'));
    @endphp
    @if (!empty($quick_links))
    <!-- quick-link start -->
    <section class="quick-content section_padding">
        <div class="container">
            <h2 class="quick-heading">Quick Links</h2>
            <div class="row pt-4">
                @foreach ($quick_links as $item)
                @php
                    $image = has_sub_field($item, 'image');
                    $title = has_sub_field($item, 'title');
                    $url = has_sub_field($item, 'url');
                @endphp
                <div class="col-12 col-sm-6 col-md-4 col-xl-2 p-2">
                    <div class="quick-box">
                        <div class="quick-img div_overflauo_hinddn">
                            <a href="{{$url ?? '#'}}" class="stretched-link d-block">
                                <img src="{{ get_image_url($image) }}"
                                    class="img-fluid animation_scale animation_scale" alt="{{$title}}">
                            </a>
                        </div>
                        <div class="quick-content">
                            <h4 class="title">
                                <a href="{{$url ?? '#'}}" class="stretched-link">{{$title}}</a>
                            </h4>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- quick-link end -->
    @endif
@endif