@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">
<link rel='stylesheet' href="{{asset('assets/css/singlebought.css')}}">

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
        text-align:left;
        display:flex;
        justify-content: center;
        border: 2px solid black;
        margin-top: 100px;
        margin-right: 200px;
        margin-left: 200px;
        width:80%;
        max-width: 1000px;
        margin-bottom: 20px;
        padding: 70px 20px 20px 20px;
        border-radius:25px;
        box-shadow: 3px 3px 2px 0px gray;
    }

   /*---------------------------------------
     CONTACT              
  -----------------------------------------*/

  .webform input,
  button.submit-button {
    height: calc(2.25rem + 20px);
  }
  .form-control:focus {
    box-shadow: none !important;
    border-color: #171819 !important;
  }

  button.submit-button {
    background: var(--dark-color);
    border-color: transparent;
    color: var(--white-color);
    cursor: pointer;
    transition: all 0.3s ease;
  }

  button.submit-button:hover {
    background: var(--primary-color);
  }
  .form-control {
    border-radius: var(--border-radius-small) !important;
  }


#coment
  {
    overflow: scroll; /* Добавляем полосы прокрутки */
    width: 265px; /* Ширина блока */
    height: 150px; /* Высота блока */
    padding: 5px; /* Поля вокруг текста */
    border: solid 1px black; /* Параметры рамки */
    resize: none;
    overflow-x: hidden;
  }
  @media(max-width:425px)
  {
    #coment
    {
      width:100%;
    }
    #center
    {
      padding-right:0px;
      padding-left:0px; 
    }
  }
  .info
  {
    font-size: 20px;
    font-style: italic;
    margin-bottom: 10px;
  }
  @media(max-width:954px)
  {
    .form-control 
    {
      margin-right:0px !important;
      width:100%!important;
      margin-bottom:10px;
    }
    .form-for-control
    {
      margin-right:0px !important;
      width:100%!important;
      margin-bottom:10px;
    }
  }
</style>
        <div style="display:flex;justify-content:center;">
            <div id="center" style="padding-top:20px;
            margin-right:20%;margin-left:20%;">
                <div class="col-lg-12 col-md-12 col-12">

                  <h2 class="mb-12 pb-2" data-aos="fade-up" data-aos-delay="200">Product information</h2>
                    
                  <div>
                    <div style="display:flex;justify-content:center;flex-wrap:wrap;">
                      <div style=
                      "
                      height:350px;
                      width:50%;
                      min-width:250px;
                      ">
                        <img
                        data-aos="fade-up"
                        data-aos-delay="400"  
                        id="product-img"
                        src="{{$img}}" 
                        alt=""
                        width="250px"
                        height="100%"
                        >
                      </div>
                      <div style="width:50%;min-width:250px;">
                        <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                          <div class="value">Title:</div>
                          <div class="variable">{{$title_product}}</div>
                        </div>

                        <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                          <div class="value">Count: </div>
                          <div class="variable">{{$count}}</div>
                        </div>

                        <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                          <div class="value">Common Price:</div>
                          <div class="variable">{{$price}}</div>
                        </div>

                        @isset($status)
                          <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                            <div class="value">Status:</div>
                            <div class="variable">{{$status}}</div>
                          </div>
                        @endisset
                      </div>
                    </div>
                    </div>

                    <h2 class="mb-12 pb-2" data-aos="fade-up" data-aos-delay="200">Delivery method</h2>

                    <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="value">Post type:</div>
                        <div class="variable">{{$post}}</div>
                    </div>

                    <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="value">Citie:</div>
                      <div class="variable">{{$citie}}</div>
                  </div>
                    @if ($where_in_post=="department")
                      <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="value">Branch: </div>
                        <div class="variable">{{$branch}}</div>
                      </div>
                    @endif
                    @if ($where_in_post=="parcel_machine")
                      <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="value">Parcel machine:</div>
                        <div class="variable">{{$parcel_machine}}</div>
                      </div>
                    @endif
                    @if ($where_in_post=="courier")
                      <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="value">Street:</div>
                        <div class="variable">{{$street}}</div>
                      </div>
                      <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="value">House:</div>
                        <div class="variable">{{$house_number}}</div>
                        <div class="value">Flat:</div>
                        <div class="variable">{{$flat}}</div>
                      </div>
                    @endif

                    <h2 class="mb-12 pb-2" data-aos="fade-up" data-aos-delay="200">Recipient information</h2>

                    <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="value">Name:</div>
                      <div class="variable">{{$name}}</div>
                    </div>

                    <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="value">Surname: </div>
                      <div class="variable">{{$surname}}</div>
                    </div>

                    <div class="content-item" data-aos="fade-up" data-aos-delay="400">
                      <div class="value">Phone:</div>
                      <div class="variable">{{$phone}}</div>
                    </div>

                    <h2 class="mb-12 pb-2" data-aos="fade-up" data-aos-delay="200">Coment</h2>

                    <textarea disabled id="coment" name= "coment" data-aos="fade-up" data-aos-delay="400">
                      @isset($coment)
                      {{$coment}}
                      @endisset
                    </textarea>


                    <p class ="info">
                    • you can change the delivery data while the product is at the processing stage
                    </p>
                    <p class ="info">
                    • you can also cancel the shipment at checkout, in this case the money will be returned to the card <b style="color:red;">including commission</b>
                    </p>

                <div
                  style ="display:flex;justify-content:center;flex-wrap:wrap;">
                  <form 
                  method="POST"
                  action="{{asset('/changedata')}}" 
                  class="form-for-control"
                  style ="width:30%;margin-right:10px;">
                      @csrf
                      <input type="hidden" name="id" value="{{$id_bought}}">
                      <button 
                      type="submit" 
                      class="form-control submit-button" 
                      
                      name="change"
                      value="change"
                      >Change Data</button>
                  </form>
                  <form 
                  method="POST"
                  action="{{asset('/cancelbought')}}" 
                  class="form-for-control"
                  style ="width:30%;margin-right:10px;">
                      @csrf
                      <input type="hidden" name="id" value="{{$id_bought}}">
                      <button 
                      type="submit" 
                      class="form-control submit-button" 
                      id="cancel" 
                      name="cancel"
                      >Cancel The Shipment</button>
                  </form>
                  <form 
                  method="GET"
                  action="{{asset('/boughtanswer')}}" 
                  class="form-for-control"
                  style ="width:30%">
                
                      <button 
                      type="submit" 
                      class="form-control submit-button" 
                      
                      name="back"
                      value="return"
                      >Back To The Page Of Purchases</button>
                    
                  </form>
                </div>

                
            </div>
        </div>
        <script src="{{asset('assets/js/aos.js')}}"></script>
        <script src="{{asset('assets/js/smoothscroll.js')}}"></script>
        <script src="{{asset('assets/js/custom_profile.js')}}"></script>
        <script>
          $("#cancel").on("click",
          function () {
            if (confirm("are you shure?")) {
                return true;
            } else {
                return false;
            }
          });
        </script>

@endsection