@php
    Theme::asset()->usePath()->add('breadcrumbs-css', 'assets/css/breadcrumbs.css');
@endphp
{!! Theme::partial('header') !!}

    <main id="main_content">
        {!! Theme::partial('breadcrumbs') !!}
        @php
            $page = Theme::get('page');
        @endphp
        		<section class="ptb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h1>{{$page->name}}</h1>
						<hr>
					</div>
					
					@if ($page)
                        {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, ($page->content), $page) !!}
                    @else
                        {!! Theme::content() !!}
                    @endif
				</div>
			</div>
		</section>
        
    </main>

@include('theme.'.Theme::getThemeName().'::views.common.ld_json', ['page' => $page])
{!! Theme::partial('footer') !!}
