<div class="row">
    @if (count($pages) > 0)
        <ul class="search-list">
            @foreach ($pages as $page)
                <li class="">
                    <a href="{{ $page->url }}" class="squared">
                        <span class="spoofer">{{ $page->name }}</span>
                    </a>
                    <p>{{ $page->description }}</p>
                </li>
            @endforeach
            <div class="clearfix"></div>
        </ul>
    @else
        <div class="col-md-12">
            <p>{{ __('No result available for :name', ['name' => 'pages']) }}</p>
        </div>
    @endif
</div>
<div class="clearfix"></div>
