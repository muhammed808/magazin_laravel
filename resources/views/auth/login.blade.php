
@include('auth.header')
<form class="login" action="{{url('login')}}" method="POST">

    @csrf

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <i class="fas fa-user-circle fa-5x"></i>
    <div class="text-center">
        <h4>login</h4>
    </div>
    
    
    <div class="box">
        <i class="fas fa-user"></i>
        <input  type="email" name="email" class="form-control" placeholder="email" value="{{old('email')}}" />
    </div>
    <div class="box">
        <i class="fas fa-key"></i>
        <input  type="password" name="password" class="form-control"
                placeholder="password" autocomplete="new-password"  />
    </div>
    <div class="alert alert-secondary" role="alert">
        @foreach ($errors->all() as $error)
            <i class='fas fa-exclamation-triangle'></i> {{$error}} <br>
        @endforeach
    </div>
    <input type="submit" class="btn btn-primary btn-block" name="send" value="login" />
    <span class="text-center">you don't have account? <a href="{{url('register')}}">create a new account</a> </span> 
</form>
@include('auth.footer')