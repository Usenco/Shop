<?
if(!isset($description))$description = "login";
if(!isset($keywords))$keywords = "login";
if(!isset($title))$title = "login";
if(!isset($page))$page = "login";
?>
@extends('layouts.main')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{asset("assets/css/style_icomoon.css")}}">

<link rel="stylesheet" href="{{asset("assets/css/owl.carousel.min.css")}}">

<!-- Style -->
<link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
  
<div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="{{asset("assets/images/undraw_file_sync_ot38.svg")}}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4" style = "letter-spacing:3px;vertical-align: 25px;">
              <h3>{{ __('Login') }} <strong>Colorlib</strong></h3>
              <p class="mb-4">                               
                enter your email and password to access additional functions of the site
              </p>
            </div>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="field--not-empty form-group first">
                    
                    
                    <label for="email" >{{ __('E-Mail Address') }}</label>
                    
                            
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    

              </div>
              <div class="field--not-empty form-group last mb-4">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              </div>
              <div class="d-flex mb-5 align-items-center">
                  
                    <label class="control control--checkbox mb-0" for="remember">
                        <span class="caption">Remember me</span>
                        <input type="checkbox" class="form-check-input control--checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                        <div class="control__indicator"></div>
                    </label>
                     
                    @if (Route::has('password.request'))
                        <span class="ml-auto"><a href="{{ route('password.request') }}" class="forgot-pass">{{ __('Forgot Your Password?') }}</a></span> 
                    @endif
              </div>
              @error('email')
                <span>
                  <strong style = "font-size:14px;color:#FF2627">
                    inconsistency between our data and your
                  </strong>
                </span>
              @enderror  
              <input type="submit" value="{{ __('Login') }}" class="btn text-white btn-block btn-primary">
            
              <span class="d-block text-left my-4 text-muted"> or sign in with</span>
              
              <div class="social-login">
                <a href="#" class="facebook">
                  <span class="fa fa-facebook" aria-hidden="true"></span>
                
                </a>
                <a href="#" class="twitter">
                  <span class="fa fa-twitter" aria-hidden="true"></span> 
                </a>
                <a href="#" class="google">
                  <span class="fa fa-google-plus" aria-hidden="true"></span>
                </a>
              </div>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  <script src="{{asset("assets/js/popper.min.js")}}"></script>
  <script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
  <script src="{{asset("assets/js/main.js")}}"></script>
@endsection
