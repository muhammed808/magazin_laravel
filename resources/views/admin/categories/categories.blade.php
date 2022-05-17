@include('admin.header') 
@include('admin.navbar')
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>{{$page_titel}} </h2> 
                     <a href="{{route('categories.create')}}" style="float: right">
                        <button class="btn btn-primary"><i class="fa fa-plus"></i> Add category</button>
                     </a>  
                    </div>

                    
                </div>              
                 <!-- /. ROW  -->
                  <hr />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>category</td>
                            <td>date</td>
                            <td>count posts</td>
                            <td>control</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rows)

                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{date("jS F, Y",strtotime($row->created_at))}}</td>
                                    <td>{{$countPost[$row->id]}}</td>
                                    <td>
                                        <a href="{{route('categories.edit' ,  $row->id )}}" class="btn btn-success"><i class="fa fa-edit"></i> edit </a>
                                        {{-- <a href="{{route('posts.destroy' , ['post' => $row->id])}}" class="btn btn-warning"><i class="fa fa-times"></i> delete </a> --}}
                                        <form method="POST" action="{{route('categories.destroy' , $row->id )}}" style="display: inline-block">
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
            </div>
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
@include('admin.footer')
