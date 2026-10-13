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
                    
                    // Determine icon based on title
                    $icon = 'fa-file-text';
                    if (stripos($title, 'publication') !== false) {
                        $icon = 'fa-book';
                    } elseif (stripos($title, 'library') !== false) {
                        $icon = 'fa-university';
                    } elseif (stripos($title, 'rti') !== false || stripos($title, 'information') !== false) {
                        $icon = 'fa-info-circle';
                    } elseif (stripos($title, 'women') !== false || stripos($title, 'committee') !== false || stripos($title, 'icc') !== false) {
                        $icon = 'fa-users';
                    } elseif (stripos($title, 'tender') !== false) {
                        $icon = 'fa-gavel';
                    } elseif (stripos($title, 'training') !== false || stripos($title, 'programme') !== false) {
                        $icon = 'fa-graduation-cap';
                    } elseif (stripos($title, 'job') !== false || stripos($title, 'notification') !== false) {
                        $icon = 'fa-briefcase';
                    }
                @endphp
                <div class="col-12 col-sm-6 col-md-4 col-xl-2 p-2">
                    <div class="quick-box">
                        <a href="{{$url ?? '#'}}" class="quick-link-wrapper">
                            <div class="quick-icon">
                                <i class="fa {{$icon}}"></i>
                            </div>
                            <div class="quick-title">
                                <span>{{$title}}</span>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- quick-link end -->
    @endif
@endif