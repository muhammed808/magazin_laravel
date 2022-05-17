@include('header')
@include('navbar')

	<!-- END #fh5co-header -->
	<div class="container-fluid">
		<div class="row fh5co-post-entry">
			@foreach ($rows as $row)
				<article class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-xxs-12 animate-box">
					<figure>
						<a href="{{url('single/'.$row->slag)}}"><img src="{{url('uploads/'.$row->image)}}" alt="Image" class="img-responsive"></a>
					</figure>
					<span class="fh5co-meta"><a href="{{url('single/'.$row->slag)}}">{{$row->name}}</a></span>
					<h2 class="fh5co-article-title"><a href="{{url('single')}}">{{$row->title}}</a></h2>
					<span class="fh5co-meta fh5co-date">{{date("jS F, Y",strtotime($row->created_at))}}</span>
					<span class="fh5co-meta fh5co-date">{{$row->user_name}}</span>
				</article>
			@endforeach
			<div class="clearfix visible-xs-block"></div>
			
		</div>
		<span style="text-align: center;">
			{{$rows->onEachSide(5)->links()}}
		</span>
	</div>

	@include('footer')