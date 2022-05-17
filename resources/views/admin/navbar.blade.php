<div id="wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
       <div class="adjust-nav">
           <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="{{url('/')}}">
   
                <div class="logo">
                    <span>abu</span>hassiba
                </div> 
                
               </a>
           </div>
            <span style="font-size: 18px;" class="logout-spn" >
                @auth
                   <span style="color:#FFF;font-size: 13px;">hi {{Auth::user()->name}}</span>
               @endauth
           </span>
       </div>
      
   </div>
   <!-- /. NAV TOP  -->
   <nav class="navbar-default navbar-side" role="navigation">
       <div class="sidebar-collapse">
           <ul class="nav" id="main-menu">
            

               <li class="<?= $page_hover == 'dashboard' ? 'active-link' : '' ?>">
                   <a href="{{url('admin')}}" ><i class="fa fa-desktop "></i>Dashboard</a>
               </li>
              
               <li class="<?= $page_hover == 'categories' ? 'active-link' : '' ?>">
                   <a href="{{route('categories.index')}}"><i class="fa fa-table "></i>categories </a>
               </li>
               <li class="<?= $page_hover == 'posts' ? 'active-link' : '' ?>">
                   <a href="{{route('posts.index')}}"><i class="fa fa-edit "></i>posts </a>
               </li>
               <li class="<?= $page_hover == 'users' ? 'active-link' : '' ?>">
                   <a href="{{route('users.index')}}"><i class="fa fa-user "></i>users </a>
               </li>
               <li class="<?= $page_hover == 'edit profile' ? 'active-link' : '' ?>">
                   <a href="{{route('users.edit' , Auth::user()->id)}}"><i class="fa fa-edit "></i>edit my profile </a>
               </li>
               <li>
                <form action="{{route('posts.show' ,Auth::user()->id )}}">
					<div class="form-group">
						<input type="text" name="find" class="form-control" placeholder="search posts">
					</div>
				</form>
               </li>
               <li>
                <a href="{{url('logout')}}"> <i class="fas fa-sign-out-alt"></i> LOGOUT</a> 
               </li>
</ul>
                       </div>

   </nav>
   <!-- /. NAV SIDE  -->