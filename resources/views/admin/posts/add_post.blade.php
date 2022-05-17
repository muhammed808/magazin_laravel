@include('admin.header') 
<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />    
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
                    <form action="{{route('posts.store')}}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">title</label>
                            <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title" placeholder="title" value="{{old('title')}}" autofocus>
                            @error('title')

                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>

                            @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">featured image</label>
                            <div class="col-sm-10">
                            <input type="file" name="image" class="form-control" id="image"value="{{old('image')}}" >
                            @error('image')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">post category</label>
                            <div class="col-sm-10">
                            <select id="category" name="category_id" class="form-control">
                                <option value="0" hidden>--select category--</option>
                                @foreach ($categories as $category)
                                    <option 
                                        value="{{$category->id}}"
                                        @if (old('category_id') == $category->id )
                                            selected
                                        @endif>
                                    {{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <h5 style="font-weight: bold">post content</h5>
                        @error('content')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        <textarea  id="summernote" name="content">{{old('content')}}</textarea>

                        <input type="submit" class="btn btn-primary" value="post" />



                        
                    </form>
                </div>
                  

                 <!-- /. ROW  -->           
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
@include('admin.footer')
<script src="{{url('summernote/summernote-lite.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({height:400});
    });
  </script>