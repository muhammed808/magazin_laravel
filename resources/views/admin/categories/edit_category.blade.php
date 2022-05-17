@include('admin.header')   
@include('admin.navbar')

<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$page_titel}} </h2>   
            </div>                    
        </div>              
            <!-- /. ROW  -->
            <hr />
        <div class="container">
            @if ($row)
                
                <form action="{{route('categories.update', $row->id )}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">name</label>
                        <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{$row->name}}" autofocus>
                        @error('name')

                            <div class="alert alert-danger">
                                {{$message}}
                            </div>

                        @enderror
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="save" />

                </form>
            @else
                <div class="alert alert-danger">sorry you can't edit this category</div>
            @endif    
        </div>
            <!-- /. ROW  -->           
    </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
@include('admin.footer')
