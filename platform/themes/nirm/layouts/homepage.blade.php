{!! Theme::partial('header') !!}
<main id="main_content">
    @php
        $page = Theme::get('page');
    @endphp
    @if (function_exists('get_sliders'))
        @php
            $sliders = get_sliders();
            $id = rand(1000, 9999);
        @endphp
        @if (!$sliders->isEmpty())
            <section class="main-slider">
                <div class="home-slider">
                    <div class="swiper mySwiper" id="main-slider">
                        <div class="swiper-wrapper">
                            @foreach ($sliders as $item)
                                <div class="swiper-slide">
                                    <img src="{{ RvMedia::getImageUrl($item->image ?? null) }}" class="img-fluid"
                                        alt="{{ $item->title }}">
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
        {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, $page->content, $page) !!}
    @else
        {!! Theme::content() !!}
    @endif
    @php $showInfoSection = false; @endphp
    @if ($showInfoSection && function_exists('get_posts_by_category_name'))
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
                                            <a class="read-btn border_radias_5px" href="{{ $item['category']->url }}"
                                                title="Read More">Read More &gt;&nbsp;</a>
                                        </div>
                                    </div>
                                    <div class="info-box-wrapper">
                                        <div class="marquee">
                                            @php
                                                $posts = $item['posts'];
                                            @endphp
                                            <div class="info-contant"
                                                @if ($posts->count() < 4) style="animation: unset!important" @endif>
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
                        @php
                            $tweets = get_tweets();
                        @endphp
                        <div class="col-lg-4 col-12 info-box twitter-box">
                            <div class="info border_radias_5px" style="background: none">
                                <div class="info-wrap">
                                    <div>
                                        <h4>
                                            Posts from @nirmrockmech
                                        </h4>
                                    </div>
                                    <div class="info-footer">
                                        <a class="read-btn border_radias_5px" href="https://x.com/nirmrockmech"
                                            title="Follow on X" target="_blank">Follow on X</a>
                                    </div>
                                </div>
                                <div class="info-box-wrapper marquee" style="padding: 0">
                                    <div class="twitter-feed info-contant">
                                        @foreach ($tweets as $tweet)
                                            @php
                                                $username = '@' . $tweet->content['user_username'];
                                            @endphp
                                            <div class="tweet">
                                                <div class="tweet-header">
                                                    <span class="tweet-author">{{ $tweet->content['user_name'] }}
                                                        ({{ $username }})</span>
                                                    <span
                                                        class="tweet-time">{{ \Carbon\Carbon::parse($tweet->content['created_at'])->diffForHumans() }}</span>
                                                </div>
                                                <div class="tweet-content">
                                                    <p>{!! $tweet->content['full_text'] !!}</p>
                                                    <a href="{{ $tweet->content['tweet_url'] }}" target="_blank">View on
                                                        X</a>
                                                </div>
                                                <div class="tweet-meta">
                                                    @if (!empty($tweet->content['referenced_tweet_url']))
                                                        <div class="referenced-tweet">
                                                            <a href="{{ $tweet->content['referenced_tweet_url'] }}"
                                                                target="_blank">Referenced X</a>
                                                        </div>
                                                    @endif
                                                    @if (!empty($tweet->content['media']))
                                                        <div class="media">
                                                            @foreach ($tweet->content['media'] as $media)
                                                                @if ($media['type'] === 'photo')
                                                                    <img src="{{ $media['url'] }}" alt="Tweet Media">
                                                                @elseif ($media['type'] === 'video' || $media['type'] === 'animated_gif')
                                                                    <video controls>
                                                                        <source src="{{ $media['url'] }}"
                                                                            type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif
    <section class="connect-section section_padding">
    <div class="container">
        <div class="connect-wrap border_radias_5px">
            <div class="connect-text">
    <h4>Stay Connected</h4>
    @foreach (get_posts_by_category_name() as $item)
    <a class="read-btn border_radias_5px" href="{{ $item['category']->url }}"
       title="{{ $item['category']->name }}">{{ $item['category']->name }} &gt;</a>
@endforeach
</div>

            <ul class="social-links" aria-label="Social media links">
    <li>
        <a href="https://www.linkedin.com/in/nirm-rock-mech-india/" target="_blank" rel="noopener noreferrer"
            aria-label="LinkedIn (opens in a new tab)" title="LinkedIn">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor" aria-hidden="true">
                <path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9.5h4v11H3v-11zm6.5 0h3.8v1.5h.1c.5-1 1.8-1.8 3.7-1.8 4 0 4.7 2.6 4.7 6V20.5h-4v-5c0-1.2 0-2.8-1.7-2.8s-2 1.3-2 2.700v5.1h-4v-11z"/>
            </svg>
        </a>
    </li>
    <li>
        <a href="https://www.instagram.com/nirm_rockmech/" target="_blank" rel="noopener noreferrer"
            aria-label="Instagram (opens in a new tab)" title="Instagram">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="3" width="18" height="18" rx="5"/>
                <circle cx="12" cy="12" r="4"/>
                <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
            </svg>
        </a>
    </li>
    <li>
        <a href="https://www.facebook.com/profile.php?id=61572224648911" target="_blank" rel="noopener noreferrer"
            aria-label="Facebook (opens in a new tab)" title="Facebook">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor" aria-hidden="true">
                <path d="M13.5 22v-8.2h2.8l.5-3.3h-3.3V8.4c0-.9.4-1.7 1.8-1.7h1.6V3.8c-.3 0-1.3-.2-2.5-.2-2.5 0-4.2 1.5-4.2 4.3v2.6H7.4v3.3h2.8V22h3.3z"/>
            </svg>
        </a>
    </li>
    <li>
        <a href="https://x.com/nirmrockmech" target="_blank" rel="noopener noreferrer"
            aria-label="X (opens in a new tab)" title="X">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true">
                <path d="M17.8 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.3L5.3 21H2.2l7.2-8.3L1.8 3h6.4l4.4 5.8L17.800 3zm-1.100 16.200h1.700L7.300 4.700H5.500l11.200 14.500z"/>
            </svg>
        </a>
    </li>
</ul>
        </div>
    </div>
</section>
    @include('theme.' . Theme::getThemeName() . '::views.custom-fields.quick_links')
    @include('theme.' . Theme::getThemeName() . '::views.custom-fields.external_links')
    @include('theme.' . Theme::getThemeName() . '::views.custom-fields.galleries')

    @php
        $other_content = \MetaBox::getMetaData($page, 'other_content', true);
    @endphp
    {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, $other_content, $page) !!}
</main>

@include('theme.' . Theme::getThemeName() . '::views.common.ld_json', ['page' => $page])

{!! Theme::partial('footer') !!}

<style>
    .connect-wrap {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 24px 28px;
    background: #fff;
    border: 1px solid #e1e1e1;
}
.connect-text h4 { margin: 0; color: #222; }
.connect-text { display: flex; flex-wrap: wrap; align-items: center; gap: 16px; }
.connect-text h4 { margin: 0; }
.social-links { display: flex; gap: 12px; list-style: none; margin: 0; padding: 0; }
.social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #fff;
    color: #333;
    border: 1px solid #d0d0d0;
    transition: background .3s, color .3s;
}
.social-links a:hover,
.social-links a:focus-visible { background: #000; color: #fff; }
@media (max-width: 575px) {
    .connect-wrap { justify-content: center; text-align: center; }
    .connect-text { justify-content: center; }
}
    .twitter-box .info-wrap:nth-child(1) h4::before{
        background: none;
    }
    .twitter-box .info-wrap h4{
        padding-left: 0;
        text-transform: none;
    }
    .twitter-box .read-btn{
        background: #000000;
        color: #fff;
    }
    .twitter-feed {
        padding: 10px;
        background-color: #fff;
        max-height: 400px;
        animation: none;
        overflow-y: auto;
        width: 100%;
    }

    .tweet {
        border-bottom: 1px solid #e1e8ed;
        padding: 10px 0;
    }

    .tweet:last-child {
        border-bottom: none;
    }

    .tweet-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .tweet-author {
        font-weight: bold;
    }

    .tweet-time {
        color: #657786;
        font-size: 0.9em;
    }

    .tweet-content {
        margin: 10px 0;
    }

    .tweet-content p {
        margin: 0;
    }

    .tweet-content a {
        color: #1da1f2;
        text-decoration: none;
        margin-right: 5px;
        display: inline flow-root list-item;
    }

    .tweet-content a[href*="/hashtag/"] {
        color: #e0245e; 
        font-weight: 600; 
    }

    .tweet-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .referenced-tweet a {
        color: #1da1f2;
        text-decoration: none;
    }

    .media img,
    .media video {
        max-width: 100%;
        border-radius: 8px;
        margin-top: 10px;
    }
</style>
