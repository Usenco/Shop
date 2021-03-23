@extends('layouts.main')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
@section('content');
<link rel="stylesheet"  href="{{asset('assets/css/lightslider.css')}}"/>
<style>
div.gallery {
  border: 1px solid #ccc;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
}

div.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  display:inline;
  width: 32.99999%;
}

.btn:hover
{
  box-shadow: 1px 1px 1px 0 black;
}

/***** */

#halfitem{
    display:inline;width:46%;margin:15px;
  }

@media only screen and (max-width: 900px) {
  .responsive {
    width: 89.99999%;
    margin: 6px 0;
  }
  #halfitem{
width:100%;
  }
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 100%;
  }
  #halfitem{width:100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
/****** */
ul{
			list-style: none outside none;
		    padding-left: 0;
            margin: 0;
		}
        .demo .item{
            margin-bottom: 60px;
        }
		.content-slider li{
		    background-color: #ed3020;
		    text-align: center;
		    color: #FFF;
		}
		.content-slider h3 {
		    margin: 0;
		    padding: 70px 0;
		}
</style>
<script src="{{asset('assets/js/lightslider.js')}}"></script>
<script>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:5,
                slideMargin: 0,
                speed:800,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
		});
    </script>

<div style = "display:flex;padding:15px;justify-content:center;flex-flow:wrap;">
<div id = "halfitem">
<div>
  <div class="demo">
        <div class="item" style = "width:84%;margin-right:8%;margin-left:8%;">            
            <div class="clearfix">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                    <li data-thumb="">
                    <div class="responsive">
                         <div class="gallery">
                           <a target="_blank" href="{{asset("$product->mainimg")}}">
                             <img src="{{asset("$product->mainimg")}}" alt="Forest" width="600" height="400">
                           </a>
                         </div>
                     </div>
                         </li>
                    @foreach($images as $item)
                    <li data-thumb="{{asset("$item->pathimg")}}"> 
                    <div class="responsive">
                         <div class="gallery">
                           <a target="_blank" href="{{asset("$item->pathimg")}}">
                             <img src="{{asset("$item->pathimg")}}" alt="Forest" width="600" height="400">
                           </a>
                         </div>
                     </div>
                         </li>
                    @endforeach
                </ul>
            </div>
        </div>
  </div>
</div>

<div class="clearfix"></div>

</div>

<div id = "halfitem">
<div class="card" style="">
  <div class="card-body">
    <h2 class="card-title"><?=$product->title?></h2>
    <h6 class="card-subtitle mb-2 text-muted">Cod:<?=$product->id?></h6>
       <h3>Price: {{$product->price}}</h3>
    <p class="text-justify">Ambitioni dedisse scripsisse iudicaretur.
   Cras mattis iudicium purus sit amet fermentum.
    Donec sed odio operae, eu vulputate felis rhoncus. 
    Praeterea iter est quasdam res quas ex communi. 
    At nos hinc posthac, sitientis piros Afros.
     Petierunt uti sibi concilium totius Galliae in
   diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
   <p>Brands</p>
   <div style="display:flex">
       <form action="{{asset('/product')}}" method="post" style = "margin-right:2px">
         
         <input type="hidden" value="{{ csrf_token() }}" name="_token">
         <input hidden type="text" name = "product" value = "{{$product->id}}">
         <input hidden type="text" name = "user" value = "{{ Auth::user()->id }}">
         <button name = "favorite" value = "favorite" type="submit" class="btn btn-outline-warning" style = "background-color:orange">To Favorite</button>
       </form>
       <form action="{{asset('/buyform')}}" method="post" style = "margin-left:2px">
           <input hidden type="text" name = "product" value = "{{$product->id}}">
           <input type="hidden" value="{{ csrf_token() }}" name="_token">  
            <button name = "buy" value = "buy" type="submit" class="btn btn-outline-warning" style = "background-color:orange">Buy</button>
        </form>
       
   </div>
  </div>
</div>
</div>
</div>


@endsection