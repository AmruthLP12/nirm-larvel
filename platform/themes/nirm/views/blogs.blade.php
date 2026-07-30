<!-- page-header -->
<section class="services-leg">
    <div class="container">
        <div class="row m-b-20">
            <div class="col-lg-12">
                <h1 class="value">Blogs from Nirm</h1>
                <hr>
                <p>Welcome to the Nirm Blog, your gateway to a world of knowledge and insights at the intersection of technology, digital marketing, web development, and cybersecurity. Our blog is designed to be your trusted resource, where our experts share their expertise, experiences, and the latest industry trends. Whether you're a seasoned professional looking to stay updated or a curious learner eager to explore the digital realm, our blog offers diverse articles to inform, inspire, and guide you on your digital journey. Join us as we delve into the ever-evolving landscape of the digital world, providing valuable insights that empower you to thrive in the digital age. </p>                        
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