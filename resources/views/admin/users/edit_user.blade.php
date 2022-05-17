@include('auth.header')
<form class="login creat" action="{{route('users.update' , $row->id)}}" method="POST">

    @csrf
    @method('PUT')

    <div class="titel-registor">
        <h4>registration</h4> <i class="fas fa-pen"></i>   
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    
    <div class="box">
        <i class="fas fa-user"></i>
        <input  type="text" name="name" class="form-control" placeholder="full name"  value="{{$row->name}}" />
    </div>

    <div class="box">
                <i class="far fa-envelope"></i>
                <input  type="email" name="email" class="form-control"
                        placeholder="email" value="{{$row->email}}"
                        />
    </div>

    <div class="box">
        <i class="fas fa-key"></i>
        <input  type="password" name="password" minlength="8" class="form-control"
                placeholder="password" autocomplete="off" value=""
                />
    </div>

    <div class="alert alert-secondary" role="alert">
        @foreach ($errors->all() as $error)
            <i class='fas fa-exclamation-triangle'></i> {{$error}} <br>
        @endforeach
    </div>
    <input type="submit" class="btn btn-primary btn-block" value="edit" />     
</form>
@include('auth.footer')