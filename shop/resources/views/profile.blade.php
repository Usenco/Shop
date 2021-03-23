@extends('layouts.main')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
@section('content');


<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">

<!-- MAIN CSS -->
{{-- <link rel="stylesheet" href="{{asset('assets/css/tooplate-gymso-style.css')}}"> --}}
<style>
    :root {
    --primary-color:        #f13a11;
    --white-color:          #ffffff;
    --dark-color:           #171819;
    --about-bg-color:       #f9f9f9;

    --gray-color:           #909090;
    --link-color:           #404040;
    --p-color:              #666262;

    --base-font-family:     'Plain', sans-serif;
    --font-weight-bold:     bold;
    --font-weight-normal:   normal;
    --font-weight-light:    300;
    --font-weight-thin:     100;

    --h1-font-size:         48px;
    --h2-font-size:         36px;
    --h3-font-size:         28px;
    --h4-font-size:         24px;
    --h5-font-size:         22px;
    --h6-font-size:         22px;
    --p-font-size:          18px;
    --base-font-size:       16px;
    --menu-font-size:       14px;

    --border-radius-large:  100%;
    --border-radius-small:  2px;
  }
    #center
    {
        display:flex;
        justify-content: center;
        border: 2px solid black;
        margin-top: 100px;
        margin-right: 25%;
        margin-left: 25%;
        margin-bottom: 20px;
        padding: 70px 20px 20px 20px;
        border-radius:25px;
        box-shadow: 3px 3px 2px 0px gray;
    }

   /*---------------------------------------
     CONTACT              
  -----------------------------------------*/

  .webform input,
  button#submit-button {
    height: calc(2.25rem + 20px);
  }
  .form-control:focus {
    box-shadow: none !important;
    border-color: #171819 !important;
  }

  button#submit-button {
    background: var(--dark-color);
    border-color: transparent;
    color: var(--white-color);
    cursor: pointer;
    transition: all 0.3s ease;
  }

  button#submit-button:hover {
    background: var(--primary-color);
  }
  .form-control {
    border-radius: var(--border-radius-small) !important;
  }


</style>
        <div>
            <div style="display: flex; justify-content: center;align-items: center;">
                <div style="margin-top:180px;position:absolute; border:1px solid black;border-radius: 50%; padding:15px;background-color: white;">
                    <img 
                    width="100px" 
                    height="100px" 
                    src="https://image.flaticon.com/icons/png/512/16/16363.png" 
                    alt="">
                </div>
            </div>
            <div id="center">
                <div class="col-lg-12 col-md-12 col-12">
                    <h2 class="mb-12 pb-2" data-aos="fade-up" data-aos-delay="200">What do you want to change</h2>

                    <form action="#" method="post" class="contact-form webform" data-aos="fade-up" data-aos-delay="400" role="form">
                        <input type="text" class="form-control" name="cf-name" placeholder="Name" style="margin-bottom:18px">
                        <input type="text" class="form-control" name="cf-name" placeholder="Surname" style="margin-bottom:18px">

                        <input type="email" class="form-control" name="cf-email" placeholder="Email" style="margin-bottom:18px">

                        <input type="phone" class="form-control" name="cf-name" placeholder="Number phone" style="margin-bottom:18px">
                        <input type="password" class="form-control" name="cf-name" placeholder="Password" style="margin-bottom:18px">
                        <input type="Repeat password" class="form-control" name="cf-name" placeholder="Repeat password" style="margin-bottom:18px">


                        

                        

                        <button type="submit" class="form-control" id="submit-button" name="submit">Save Change</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{asset('assets/js/aos.js')}}"></script>
        <script src="{{asset('assets/js/smoothscroll.js')}}"></script>
        <script src="{{asset('assets/js/custom_profile.js')}}"></script>
@endsection
