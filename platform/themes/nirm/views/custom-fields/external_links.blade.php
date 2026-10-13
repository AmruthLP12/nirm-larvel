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
                            
                            // Determine icon based on title
                            $icon = 'fa-globe';
                            $iconColor = '#10399d';
                            
                            if (stripos($title, 'grievance') !== false || stripos($title, 'public') !== false) {
                                $icon = 'fa-comments';
                                $iconColor = '#e74c3c';
                            } elseif (stripos($title, 'data.gov') !== false || stripos($title, 'data') !== false) {
                                $icon = 'fa-database';
                                $iconColor = '#3498db';
                            } elseif (stripos($title, 'mygov') !== false) {
                                $icon = 'fa-users';
                                $iconColor = '#e67e22';
                            } elseif (stripos($title, 'ministry') !== false || stripos($title, 'mines') !== false) {
                                $icon = 'fa-building';
                                $iconColor = '#2c3e50';
                            } elseif (stripos($title, 'digital') !== false || stripos($title, 'india') !== false) {
                                $icon = 'fa-wifi';
                                $iconColor = '#16a085';
                            } elseif (stripos($title, 'swachh') !== false || stripos($title, 'bharat') !== false) {
                                $icon = 'fa-leaf';
                                $iconColor = '#27ae60';
                            } elseif (stripos($title, 'make in india') !== false || stripos($title, 'makeinindia') !== false) {
                                $icon = 'fa-industry';
                                $iconColor = '#f39c12';
                            } elseif (stripos($title, 'incredible') !== false || stripos($title, 'tourism') !== false) {
                                $icon = 'fa-plane';
                                $iconColor = '#e91e63';
                            } elseif (stripos($title, 'pmn') !== false || stripos($title, 'relief') !== false) {
                                $icon = 'fa-heart';
                                $iconColor = '#c0392b';
                            } elseif (stripos($title, 'india.gov') !== false) {
                                $icon = 'fa-university';
                                $iconColor = '#34495e';
                            } elseif (stripos($title, 'diksha') !== false || stripos($title, 'education') !== false) {
                                $icon = 'fa-graduation-cap';
                                $iconColor = '#9b59b6';
                            } elseif (stripos($title, 'voter') !== false || stripos($title, 'election') !== false) {
                                $icon = 'fa-check-square';
                                $iconColor = '#d35400';
                            } elseif (stripos($title, 'amrit') !== false || stripos($title, 'mahotsav') !== false) {
                                $icon = 'fa-flag';
                                $iconColor = '#ff6b6b';
                            } elseif (stripos($title, 'pledge') !== false) {
                                $icon = 'fa-hand-peace-o';
                                $iconColor = '#2ecc71';
                            }
                        @endphp
                        <div class="swiper-slide ">
                            <div class="client-item-new">
                                <a href="{{$url ?? '#'}}" class="external-link-wrapper" title="{{$title}}" target="_blank">
                                    <div class="external-icon" style="color: {{$iconColor}}">
                                        <i class="fa {{$icon}}"></i>
                                    </div>
                                    <div class="external-title">
                                        <span>{{$title}}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Add Navigation Arrows -->
                    <div class="swiper-button-next client-slider-next"></div>
                    <div class="swiper-button-prev client-slider-prev"></div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endif