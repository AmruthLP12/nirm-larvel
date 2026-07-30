<!-- page-header -->
<section class="services-leg">
    <div class="container">
        <div class="row m-b-20">
            <div class="col-lg-12">
                <h1 class="value">{{ $category->name }}</h1>
                <hr>
                {{-- @if (!empty($category->description))
                <p>{{ $category->description }}</p>                        
                <hr>
                @endif --}}
            </div>
		</div>
        <div class="row mt-n5">
            @forelse($posts as $post)
            <div class="col-md-6 col-lg-4 mt-5 wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                <div class="blog-grid">
                    <div class="blog-grid-img position-relative">
                        <a href="{{ $post->url }}">
                            <img 
                                class="img-fluid rounded lazyload"
                                data-src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" 
                                alt="{{ $post->name }}">
                        </a>
                    </div>
                    <div class="blog-grid-text p-4">
                        <h3 class="h5 mb-3"><a href="{{ $post->url }}">{{ $post->name }}</a></h3>
                        <p class="display-30">{{ $post->description }}</p>
                        <div class="meta meta-style2">
                            <ul>
                                <li><a href="#!"><i class="fas fa-calendar-alt"></i>  {{$post->created_at->format('M d, Y')}}</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-6 col-lg-4 mt-5 wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                There is no data to display!
            </div>
            @endforelse
        </div>
        <div class="row mt-6 wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
            <div class="col-12">
                {{$posts->appends(request()->all())->links()}}
            </div>
        </div>
    </div>
</section>