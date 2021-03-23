<?
if(!isset($description))$description = "register";
if(!isset($keywords))$keywords = "register";
if(!isset($title))$title = "register";
if(!isset($page))$page = "register";
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
              <h3>{{ __('Register') }}<strong>Colorlib</strong></h3>
              <p class="mb-4">                               
                enter your email and password to access additional functions of the site
              </p>
            </div>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="field--not-empty form-group first">
                    
                    
                    <label for="name" >{{ __('Name') }}</label>
                    
                            
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="field--not-empty form-group last mb-4">
                    
                    
                    <label for="email" >{{ __('E-Mail Address') }}</label>
                    
                            
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="field--not-empty form-group last mb-4">
                    
                    
                    <label for="phone" >{{ __('Phone') }}</label>
                
                        
                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="field--not-empty form-group last mb-4">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="field--not-empty form-group last mb-4">
                <label for="password-confirm">{{ __('Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>

              <input type="submit" value="{{ __('Register') }}" class="btn text-white btn-block btn-primary">
            
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
