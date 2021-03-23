<?
if(!isset($description))$description = "reset password link";
if(!isset($keywords))$keywords = "reset password link";
if(!isset($title))$title = "reset password link";
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
                <!------------>
              <div class="mb-4" style = "letter-spacing:3px;vertical-align: 25px;">
              <h3>{{ __('Reset Password') }} <strong>Colorlib</strong></h3>
              <p class="mb-4">                               
                enter your email, on this email will send reset password link 
              </p>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div class="field--not-empty form-group first">
                    
                    
                    <label for="email" >{{ __('E-Mail Address') }}</label>
                    
                            
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

              </div> 
              <input type="submit" value="{{ __('Send Password Reset Link') }}" class="btn text-white btn-block btn-primary">
            
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