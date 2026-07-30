@php
    $page = Theme::get('page');
    $breadcrumb_title = SeoHelper::getTitle();
    // if ($page) {
    //     $breadcrumb_title = \MetaBox::getMetaData($page, 'breadcrumb_title', true);
    // }
@endphp
{{-- <ul class="breadcrumb">
    @foreach (Theme::breadcrumb()->getCrumbs() as $i => $crumb)
        @if ($i != (count(Theme::breadcrumb()->getCrumbs()) - 1))
            <li><a href="{{ $crumb['url'] }}">{!! $crumb['label'] !!}</a><span class="divider">/</span></li>
        @else
            <li class="active">{!! $crumb['label'] !!}</li>
        @endif
    @endforeach
</ul> --}}
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs-content">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                @foreach (Theme::breadcrumb()->getCrumbs() as $i => $crumb)
                    @if ($i != (count(Theme::breadcrumb()->getCrumbs()) - 1))
                    <li class="breadcrumb-item">
                        <a href="{{ $crumb['url'] }}">{!! $crumb['label'] !!}</a>
                    </li>
                    @else
                    <li class="breadcrumb-item active" aria-current="page">{!! $page->name ?? $breadcrumb_title !!}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</section>
<!-- End Breadcrumbs -->