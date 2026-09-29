@extends('layouts.layout')

@section('content')
<section id="loginPage" class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="login-container">
        <div class="row">
            <div class="col-md-5">
               <img src="{{ url('resources/views/Logo.png')}}" style="max-width: 100%;height: 80%;margin-top: 23%;">
            </div>
            <div class="col-md-7">
                <div class="login-form-container">
                <div class="brand-logo">
                    <h2 class="text-center uppercase bold">KV Management LLC</h2>
                    <h4 class="text-center" style="font-weight: bold;color: #fff">LOGIN</h4>
                </div>
                <form class="widget" style="background: #073776;margin-bottom: 0" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                   

                    <div class="widget-content">
                                                   

                            <div style="margin-bottom: 20px;" class="row  form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-sm-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="username" style="font-size: 16px;
    font-weight: bold;">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-sm-12">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="********" style="font-size: 16px;
    font-weight: bold;">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    
                    <div class="widget-footer">
                        <div class="checkbox inline">
                            <!-- <label><input type="checkbox" value="">Remember me</label> -->
                            <a class="text-xs text-center link-txt block" style="color:#dbe1e9;" href="{{ url('/password/reset') }}">Forgot Password?</a>
                        </div>
                        <button type="submit" class="v-btn v-btn-primary pull-right">
                            SUBMIT
                        </button>
                    </div>
                </form>
            </div>
            </div>
                
            </div>
        </div>
            </div>
        </div>
        
    </div>
    </div>
</section>  
<style type="text/css">
    .login-container {
    background: #dbe1e9;
    box-shadow: 5px 10px 5px #000;
}
.login-form-container{
   padding: 7.3rem 2rem;
    border-radius: 0px;
    background: #073776;
}
body{
        background: url(http://actiknowdemo.com/bg1.png);
}
</style>
@endsection
