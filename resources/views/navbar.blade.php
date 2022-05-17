
	<div id="fh5co-offcanvas">
		<a href="#" class="fh5co-close-offcanvas js-fh5co-close-offcanvas"><span><i class="icon-cross3"></i> <span>Close</span></span></a>
		<div class="fh5co-bio">
			<figure>
				<img src="{{url('assets/images/person1.jpg')}}" alt="Free HTML5 Bootstrap Template" class="img-responsive">
			</figure>
			<h3 class="heading">About Me</h3>
			<h2>Emily Tran Le</h2>
			<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
			<ul class="fh5co-social">
				{{-- <li><a href="#"><i class="icon-twitter"></i></a></li>
				<li><a href="#"><i class="icon-facebook"></i></a></li>
				<li><a href="#"><i class="icon-instagram"></i></a></li> --}}
				<li><a style="color:#F00" href="{{url('login')}}">login</a> | <a style="color:#F00" href="{{url('register')}}">signup</a> | <a style="color:#F00" href="{{url('admin')}}">admin</a></li>
			</ul>
		</div>

		<div class="fh5co-menu">
			<div class="fh5co-box">
				<h3 class="heading">Categories</h3>
				<ul>
					<form action="{{url('/')}}">
						@foreach ($rowsCategories as $row)
							<li><a href="{{url('/?cate='.$row->id)}}">{{$row->name}}</a></li>
						@endforeach
					</form>
					{{-- <li><a href="#">Style</a></li>
					<li><a href="#">Photography</a></li>
					<li><a href="#">Food &amp; Drinks</a></li>
					<li><a href="#">Culture</a></li> --}}

				</ul>
			</div>
			<div class="fh5co-box">
				<h3 class="heading">Search</h3>
				<form action="{{url('/')}}">
					<div class="form-group">
						<input type="text" name="find" class="form-control" placeholder="Type a keyword">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END #fh5co-offcanvas -->
	<header id="fh5co-header">
		
		<div class="container-fluid">

			<div class="row">
				<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
				<ul class="fh5co-social">
					<li><a href="#"><i class="icon-twitter"></i></a></li>
					<li><a href="#"><i class="icon-facebook"></i></a></li>
					<li><a href="#"><i class="icon-instagram"></i></a></li>
				</ul>
				<div class="col-lg-12 col-md-12 text-center">
					<h1 id="fh5co-logo">
						<a href="{{url('/')}}">
							<div style="text-transform: uppercase">
								<span style="color: #2ecc71">abu</span>hassiba <sup>TM</sup>
							</div>
						</a>
					</h1>
				</div>

			</div>
		
		</div>

	</header>
{{-- 
	<div class="logo">
		<span>abu</span>hassiba
	</div>  --}}