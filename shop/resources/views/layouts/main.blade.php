<?
if(!isset($description))$description = "";
if(!isset($keywords))$keywords = "";
if(!isset($title))$title = "те905";
if(!isset($description))$description = "";
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{$description}}">
    <meta name="robots" content="index,follow" />
    <meta name="keywords" content="{{$keywords}}" />
    <meta name="copyright" content="те905">
    <title>"{{$title}}"</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="icon" sizes="192*192" href="{{asset('assets/images/logo.png')}}">
    
    
    <!-- Bootstrap core CSS -->
    <link href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset("assets/css/fontawesome.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/templatemo-sixteen.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/owl.css")}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('layouts.page_items.header')
    <!--MAIN CONTENT-->
    <main style = "padding-top:150px">
       @yield('content')
    </main>
    
    <!--FOOTER-->
    @include("layouts.page_items.footer")


    <!-- Bootstrap core JavaScript -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="{{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>


    <!-- Additional Scripts -->
    <script src="{{asset("assets/js/custom.js")}}"></script>
    <script src="{{asset("assets/js/owl.js")}}"></script>
    <script src="{{asset("assets/js/slick.js")}}"></script>
    <script src="{{asset("assets/js/isotope.js")}}"></script>
    <script src="{{asset("assets/js/accordions.js")}}"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>


  </body>

</html>
