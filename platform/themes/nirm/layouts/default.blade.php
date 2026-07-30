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
                    @if ($page)
                        <div class="col-lg-12">
                            <h1>{{$page->name}}</h1>
                            <hr>
                        </div>
                    @endif
					
					
					{!! Theme::content() !!}
				</div>
			</div>
		</section>
        
    </main>

@include('theme.'.Theme::getThemeName().'::views.common.ld_json', ['page' => $page])
{!! Theme::partial('footer') !!}
