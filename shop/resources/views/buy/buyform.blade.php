<?
if(!isset($description))$description = "register";
if(!isset($keywords))$keywords = "register";
if(!isset($title))$title = "register";
if(!isset($page))$page = "register";
?>


@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/buyform_style.css')}}">

<script src="{{asset('assets/js/buyform.js')}}" defer></script>


<div id="main_content">
  <div id="main_container">

    <div id="left_container">
        <div>
               <h4>Способ доставки</h4>
               <input 
               type="hidden" 
               id = btntextin 
               name= "btntext"
               @if (isset($data["btntext"]))
               value={{$data["btntext"]}}
               @else
               value=""
               @endif
               >
               <input 
               type="hidden" 
               id = btnimgin 
               name= "btnimg"
               @if (isset($data["btnimg"]))
               value={{$data["btnimg"]}}
               @else
               value=""
               @endif
               >

               <div class="drop-list">
                  <input class="number_of_selected_item" value="0" type="hidden"/>
                  <div class="selected-item">
                    <div>
                      <img src="" alt=""/>
                      <h2></h2>
                    </div>
                    <p>⮟</p>
                  </div>
                  <ul>
                    <li data-li_block="nova_poshta"><img src="{{asset('assets/images/poshts/nova_poshta.png')}}" alt="" ><h2>Nova Poshta</h2></li>
                    <li data-li_block="meest_express"><img src="{{asset('assets/images/poshts/meest.png')}}" alt="" ><h2>Meest Express</h2></li>
                    <li data-li_block="justin"><img src="{{asset('assets/images/poshts/justin.svg')}}" alt="" ><h2>Justin</h2></li>
                    <li data-li_block="delivery"><img src="{{asset('assets/images/poshts/delivery.png')}}" alt="" ><h2>Delivery</h2></li>
                    <li data-li_block="pickup"><img src="{{asset('assets/images/poshts/pickup.png')}}" alt="" ><h2>Pickup</h2></li>
                  </ul>
                </div>

                <div class="drop-list">
                  <input class="number_of_selected_item" value="0" type="hidden"/>
                  <div class="selected-item">
                    <div>
                      <h2></h2>
                    </div>
                    <p>⮟</p>
                  </div>
                  <ul id="type_of_delivery">
                    <li id="In_department">
                      <h2>In department</h2>
                    </li>
                    <li id="By_courier">
                      <h2>By courier</h2>
                    </li>
                    <li id="By_parcel_machine">
                      <h2>Parcel machine</h2>
                    </li>
                  </ul>
                </div>
                 
             <div class="ui-widget" id ="citie">
               <label for="cities">город: </label>
               <input 
               id="cities" 
               class="insert" 
               autocomplete="off"
               name="citieName"
               @isset($data["citieName"])
               value="{{$data['citieName']}}"
               @endisset
               >
               <input 
               type="hidden" 
               id = "hidecitie" 
               name="citie"
               @isset($data["citie"])
               value="{{$data['citie']}}"
               @endisset>
             </div>
             <span id = "citieError">
               @isset($error["citie"])
                  <span>{{$error["citie"]}}</span>
               @endisset
             </span>
             




             <div id = "department">
               <div class="ui-widget">
                 <label for="departments">отделение: </label>
                 <input 
                 id="departments" 
                 name="depart" 
                 class="insert" 
                 autocomplete="off"
                 @isset($data["depart"])
                 value="{{$data['depart']}}"
                 @endisset
                 >
               </div>
               <span id = "departmentError">
                 @isset($error["depart"])
                   <span>{{$error["depart"]}}</span>
                 @endisset
               </span>
             </div>
             
             <div id = "parcel_machine">
               <div class="ui-widget">
                 <label for="parcel_machines">почтомат: </label>
                 <input 
                 id="parcel_machines" 
                 name="parcel_machine" 
                 class="insert" 
                 autocomplete="off"
                 @isset($data["parcel_machine"])
                 value="{{$data['parcel_machine']}}"
                 @endisset>
               </div>
               <span id = "parcel_machineError">
                 @isset($error["parcel_machine"])
                   <span>{{$error["parcel_machine"]}}</span>
                 @endisset
               </span>
             </div>
             
 
             <div id = "courier">
               <div class="ui-widget">
                 <label for="streets">street:</label>
                 <input 
                 class= "insert" 
                 name="street" 
                 id = "streets" 
                 autocomplete="off"
                 @isset($data["street"])
                 value="{{$data['street']}}"
                 @endisset>        
               </div>
               <span id = "streetError"></span>
               <div class="ui-widget">
                 <input 
                 autocomplete="off" 
                 name="house" 
                 type="text" 
                 style = "width: 50%;margin-right:10px;" 
                 placeholder="дом"
                 @isset($data["house"])
                 value= '{{$data["house"]}}'
                 @endisset>
                 <input
                 autocomplete="off" 
                 name="flat" 
                 type="number" 
                 min="1" 
                 style = "width: 50%;" 
                 placeholder="квартира"
                 @isset($data["flat"])
                 value= '{{$data["flat"]}}'
                 @endisset>
               </div>
               <span>
                 @isset($error["street"])
                   <span>{{$error["street"]}}</span>
                 @endisset
               </span>
             </div>
             <input 
             type="hidden" 
             id = "hidewhere" 
             name="where"
             @isset($data["where"])
             value="{{$data['where']}}"
             @endisset>
             <h4>Информация о получателе</h4>
             <div class="ui-widget">
               <label for="name">имя: </label>
               <input 
                type="text"
                name="name" 
                id="name" 
                class="insert"
                @isset($data["name"])
                value="{{$data['name']}}"
                @endisset>
             </div>
             @isset($error["name"])
               <span>{{$error["name"]}}</span>
             @endisset
             <div class="ui-widget">
               <label for="surname">фамилия: </label>
               <input 
               type="text"
               name="surname"
               id="surname" 
               class="insert"
               @isset($data["surname"])
               value="{{$data['surname']}}"
               @endisset>
             </div>
             @isset($error["surname"])
               <span>{{$error["surname"]}}</span>
             @endisset
             <div class="ui-widget">
               <label for="phone">телефон: </label>
               <input type="tel"
                id="phone"
                name="phone"
                placeholder="+38067123456" 
                class="insert"
                @isset($data["phone"])
                value="{{$data['phone']}}"
                @endisset
                >
             </div>
             @isset($error["phone"])
               <span>{{$error["phone"]}}</span>
             @endisset
             <h4>коментарии</h4>
             <textarea id="coment" name= "coment">
               @isset($data["coment"])
               {{$data['coment']}}
               @endisset
             </textarea>
             
        </div>
    </div>

    <div id="right_container">

      <div id="picture_container">
         <div id="picture_box">

           <div id="picture">
             <img src="{{$mainimg}}" alt="" width="100%" height="100%">
           </div>

           <div id="pedestal"></div>

         </div>
      </div>

      <div id="product_container">
        <div id="product_card">

          <h2 class="title">{{$title_p}}</h2>
          <hr>

          <p class="description">{{$description_p}}</p>

          @isset($whole_num)
            <span class="price">
              </p>При покупке от <b>{{$whole_num}}</b> едениц цена начисляеться как оптовая</p>
            </span>
          @endisset
          
          <div class = "price">
            <p>Price:</p>
            <div style = "color:darkgreen;">{{$price}}UAN</div>
          </div>

          @isset($whole_price)
            <div class = "price" >
             <p>Whole Price:</p>
             <div style = "color:red">{{$whole_price}}UAN</div>
            </div>
          @endisset

          <div class = "price">
            <p>Common Price:</p>
            <div style = "color:black"><b><span id = "comprice">4000</span>UAN</b></div>
          </div>

          <div id="switch_prices">
            <div id = "minus" class = "chooseitem" style = "border-right:0px;">
               -
            </div>
            <div id = "num">
              <p id = "numel">
                @if (isset($data["count"]))
                   {{$data["count"]}}
                @else
                    1
                @endif
              </p>
            </div>
            <div id = "plus" class = "chooseitem" style = "border-left:0px;">
             +
            </div>
         </div>

        </div>
      </div>

    </div>

  </div>
</div>

@endsection