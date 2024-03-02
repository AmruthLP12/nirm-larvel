<!-- page-header -->
<section class="services-leg">
    <div class="container">
        <div class="row m-b-20">
            <div class="col-lg-12">
                <h1 class="value">Tag #{{ $tag->name }}</h1>
                <hr>
                <p>Welcome to the Nirm | Tag #{{ $tag->name }}</p>                        
                <hr>
            </div>
			<div class="col-lg-12">
                <!-- Blog -->
               	<div class="row">
					@forelse($posts as $post)
					<!-- Post item-->
                    <div class="col-lg-4 m-b-20 m-t-20">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="{{ $post->url }}">
                                    <img 
                                        class="img-fluid rounded lazyload"
                                        data-src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" 
                                        alt="{{ $post->name }}">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <span class="post-meta-date">
									<i class="fa fa-calendar-o"></i>  {{$post->created_at->format('M d, Y')}}
								</span>
                              
                                <h2 class="cta-2615"><a class="sidemenu" href="{{ $post->url }}">{{ $post->name }}</a></h2>
                                <p class="blogp">{{$post->description}}</p>
								<a href="{{$post->url}}" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- end: Post item-->
                   	@empty
					<div class="col-lg-4">
						There is no data to display!
					</div>
					@endforelse
				</div>
                <!-- end: Blog -->

                {{$posts->appends(request()->all())->links()}}
            </div>
		</div>
	</div>
</section>