@include('admin.header') 
@include('admin.navbar')
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>{{$page_titel}} </h2> 
                     <a href="{{route('posts.create')}}" style="float: right">
                        <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Post</button>
                     </a>  
                    </div>

                    
                </div>              
                 <!-- /. ROW  -->
                  <hr />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>title</td>
                            <td>content</td>
                            <td>category</td>
                            <td>user</td>
                            <td>featured image</td>
                            <td>date</td>
                            <td>control</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rows)

                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{$row->title}}</td>
                                    <td><a href="{{route('single' , $row->slag)}}">view content</a></td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->user_name}}</td>
                                    <td><img src="{{url('uploads/'.$row->image)}}" style="width:150px;height:99px" /></td>
                                    <td>{{date("jS F, Y",strtotime($row->created_at))}}</td>
                                    <td>
                                        <a href="{{route('posts.edit' , ['post' => $row->id])}}" class="btn btn-success"><i class="fa fa-edit"></i> edit </a>
                                        {{-- <a href="{{route('posts.destroy' , ['post' => $row->id])}}" class="btn btn-warning"><i class="fa fa-times"></i> delete </a> --}}
                                        <form method="POST" action="{{route('posts.destroy' , ['post' => $row->id])}}" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-times"></i> delete </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        @endif
                        
                    </tbody>
                </table>
                <span style="text-align: center;">
                    {{$rows->links()}}
                </span>
            </div>
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
@include('admin.footer')
