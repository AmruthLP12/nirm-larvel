{!! Theme::partial('header') !!}
<main>
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
