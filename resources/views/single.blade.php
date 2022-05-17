
@include('header')
@include('navbar')
	<a href="#" class="fh5co-post-prev"><span><i class="icon-chevron-left"></i> Prev</span></a>
	<a href="#" class="fh5co-post-next"><span>Next <i class="icon-chevron-right"></i></span></a>
	<!-- END #fh5co-header -->
	<div class="container-fluid">
		<div class="row fh5co-post-entry single-entry animate-box">
			<article class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				@if (isset($rowPost))
					<figure class="animate-box">
						<img src="{{url('uploads/'.$rowPost->image)}}" alt="Image" class="main-img">
					</figure>
					<span class="fh5co-meta animate-box"><a href="{{url('single/'.$rowPost->slag)}}">{{$rowPost->name}}</a></span>
					<h2 class="fh5co-article-title animate-box"><a href="{{url('single/'.$rowPost->slag)}}">{{$rowPost->title}}</a></h2>
					<span class="fh5co-meta fh5co-date animate-box">{{date("jS F , M",strtotime($rowPost->created_at))}}</span>
				

					<div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-left content-article">
						<div class="row">
							<div class="col-lg-8 cp-r animate-box">
								<?= $rowPost->content?>
							</div>
						</div>
					</div>
				@endif
			</article>
		</div>
	</div>

@include('footer')

