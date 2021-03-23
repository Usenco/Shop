<?
if(!isset($description))$description = "register";
if(!isset($keywords))$keywords = "register";
if(!isset($title))$title = "register";
if(!isset($page))$page = "register";
?>


@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/buy.css')}}">
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{asset('assets/jquery-ui-thems/jquery-ui.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/jquery-ui-thems/jquery-ui.css')}}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<style>
  #accordion > h3
  {
     padding-left:30px;
  }
  .btn
  {
    background-color: white;
    color:black;
    border: 1px solid black;
  }
  .btn:hover 
  {
    color:black !important;
    background-color: white !important;
    box-shadow: 1px 1px 1px 1px black !important;
  }
  .btn:active 
  {
    color:black !important;
    background-color: white !important;
    box-shadow: none !important;
  }
  .btn:focus 
  {
    color:black !important;
    background-color: white !important;
    box-shadow: none !important;
  }
  .dropdown-item
  {
    cursor: pointer !important;
  }
  #leftbuycontainer
  {
    border-radius: 20px !important;
  }
  @media(max-width:1090px)
  {
      #leftbuycontainer
  {
    border-radius: 20px !important;
  }
}
</style>


<script src = "{{asset('assets/js/buy.js')}}"></script>

<div>
  <form action="{{asset('/changedata')}}" method = "POST">
    <input type="hidden" value="{{ csrf_token() }}" name="_token"> 
  <div id = "buycontainer">
    <div id = "leftbuycontainer">
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
                <div class="dropdown">
                  <button style="width:100%;font-size: 18px;height:40px;" class=" btn-secondary dropdown-toggle btn1 btn" type="button"  data-bs-toggle="dropdown" aria-expanded="false">
                      <img class="btnimg" src="data:image/png;base64,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" width="20px" height="20px" alt="">
                      <span class = "btntext">нова пошта</span>
                  </button>
                  <ul style="width:100%;font-size: 18px;text-align:center" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li class="item" data-parent = "btn1" data-url="data:image/png;base64,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" data-text="нова пошта">
                        <a class="dropdown-item">
                            <img src="data:image/png;base64,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" width="20px" height="20px" alt="">
                      Нова пошта</a></li>
                  </ul>
                </div>
                
                <div id = "postarea">
                  <div class="dropdown" id = "ukr">
                    <button style="width:100%;font-size: 18px;height:40px;" class="btn btn-secondary dropdown-toggle btn3" data-choose="department" type="button"  data-bs-toggle="dropdown" aria-expanded="false">
                     <Span class="btntext">В отделении</Span>
                    </button>
                    <ul style="width:100%;font-size: 18px;text-align:center" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li class="item" data-text = "Курьер"      data-choose="courier"   data-parent = "btn3"><a class="dropdown-item">Курьером</a></li>
                      <li class="item" data-text = "В отделении" data-choose="department"data-parent = "btn3"><a class="dropdown-item" >В отделении</a></li>
                    </ul>
                  </div>
                  <div class="dropdown" id = "new">
                    <button style="width:100%;font-size: 18px;height:40px;" class="btn btn-secondary dropdown-toggle btn2"data-choose="department" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <Span class="btntext">В отделении</Span>
                    </button>
                    <ul style="width:100%;font-size: 18px;text-align:center" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li class="item" data-text = "Курьер"      data-choose="courier"       data-parent = "btn2 "><a class="dropdown-item">Курьером</a></li>
                      <li class="item" data-text = "Поштоматом"  data-choose="parcel_machine"     data-parent = "btn2"><a class="dropdown-item">Поштоматом</a></li>
                      <li class="item" data-text = "В отделении" data-choose="department"    data-parent = "btn2"><a class="dropdown-item">В отделении</a></li>
                    </ul>
                  </div>

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

       <div style = "height:130px;width:100%;display:flex;justify-content:flex-end;align-items:flex-end">
        <button type="submit" id = "sub" style = "display:inline;" name = "sub">
          <img src="{{asset('assets/images/turn_right.png')}}">
        </button>
       </div>
    </div>
  </div>
  <input 
  type="hidden" 
  id = "count_return" 
  name = "count_return"  
  @if (isset($data["count"]))
   value = '{{$data["count"]}}'
  @else
   value = '1'
  @endif>
  <input type="hidden" id = "post_return" name = "post"
  @if (isset($data["post"]))
     value = {{$data["post"]}}
  @else
     value = 'new'
  @endif>
  <input type="hidden" id = "where_in_post" name = "where_in_post"
  @if (isset($data["where_in_post"]))
     value = '{{$data["where_in_post"]}}'
  @else
     value = 'depart'
  @endif>
  </form>
</div>

<script src="{{asset('assets/js/buy_bottom.js')}}">
</script>

@endsection