<?
if(!isset($description))$description = "new password";
if(!isset($keywords))$keywords = "new password";
if(!isset($title))$title = "new password";
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
              <h3>{{ __('Reset Password') }}<strong>Colorlib</strong></h3>
              <p class="mb-4">                               
                enter your new password and confirm this password
              </p>
            </div>
            <form action="{{ route('password.update') }}" method="post">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="field--not-empty form-group last mb-4">
                    
                    
                    <label for="email" >{{ __('E-Mail Address') }}</label>
                    
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>      
                    
                    
                    @error('email')
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
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>

              <input type="submit" value="{{ __('Reset Password') }}" class="btn text-white btn-block btn-primary">
            

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
