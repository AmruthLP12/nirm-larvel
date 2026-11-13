<div class="row">
    @if (count($pages) > 0 || count($posts) > 0 || count($media) > 0)
        @if (count($pages) > 0)
            <h2>{{ __('Pages') }}</h2>
            <ul class="search-list">
            @foreach ($pages as $page)
                <li class="">
                    <a href="{{ $page->url }}" class="squared">
                        <span class="spoofer">{{ $page->name }}</span>
                    </a>
                    <p>{{ $page->description }}</p>
                </li>
            @endforeach
            </ul>
        @endif

        @if (count($posts) > 0)
            <h2>{{ __('News and articles') }}</h2>
            <ul class="search-list">
                @foreach ($posts as $post)
                    <li>
                        <a href="{{ $post->url }}" class="squared">
                            <span class="spoofer">{{ $post->name }}</span>
                        </a>
                        <p>{{ $post->description }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        @if (count($media) > 0)
            <h2>{{ __('Documents and images') }}</h2>
            <ul class="search-list">
                @foreach ($media as $file)
                    <li>
                        <a href="{{ $file->url }}" class="squared" target="_blank" rel="noopener noreferrer">
                            <span class="spoofer">{{ $file->name }}</span>
                        </a>
                        <p>{{ $file->mime_type }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    @else
        <div class="col-md-12">
            <p>{{ $query === '' ? __('Enter a search term.') : __('No results found.') }}</p>
        </div>
    @endif
</div>
<div class="clearfix"></div>
