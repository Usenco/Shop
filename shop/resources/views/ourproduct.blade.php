@extends('layouts.main')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
@section('content');
<input type="hidden" value="{{$category}}" id="category">
<input type="hidden" value="{{$api_token}}" id="api_token">
<input id = "url" type="text" hidden value = "{{asset('/product')}}">
<link rel="stylesheet" href="{{asset('assets/css/filter_style.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    let category = $("#category").val();
    let api_token = $("#api_token").val();
    let current_page = 1;
    let max_page =1;
    let link ='http://127.0.0.1:8000/api/get_products?page=';
    let json = 
    {
      'api_token':api_token
    }
    showProducts(current_page);
    // здесь будет метод showProducts()
    function showProducts(i){
        // получить список товаров из API
        $.getJSON(link+i+"&category="+category,
        json, function(data){
            max_page = data.last_page;
            read_products_html ="";
            //let i = 0;
            $.each(data.data, function(key, val) {
                //i++;
            // создание новой строки таблицы для каждой записи 
            read_products_html+=
                `
                <div class="col-lg-4 col-md-6 col-sm-6 all des">
                <div class="product-item" style = "height:600px">
                  <a href="`+$('#url').val()+'/'+val.id+`"><img src="`+val.mainimg+`" height="350px" alt="not found"></a>
                  <div class="down-content">
                    <a href="`+"#"+`"><h4 style = "margin-right:60px;height:40px;overflow: hidden;">`+val.title+`</h4></a>
                    <h6>`+val.price+`</h6>
                    <p style = "height:90px;overflow: hidden; text-overflow: ellipsis;">`+val.description+`</p>
                    <ul class="stars">`;
            for (let index = 0; index < val.mark; index++) {
                      
                read_products_html+=`<li><i class="fa fa-star"></i></li>`;
            }
                      
            read_products_html+=
            `        </ul>
                    <span>Reviews(`+val.reviews+`)</span>
                  </div>
                </div>
                </div>
                `;
            
            });
        document.querySelector("#next_page").onclick = function()
        {
          if(current_page+1 <=max_page){
            current_page++;
            showProducts(current_page);   
            refreshpagingM(current_page);
            window.scrollTo(470, 470);
          }
        }
        document.querySelector("#prev_page").onclick = function()
        {
          if(current_page-1>0){
            current_page--;
            showProducts(current_page);   
            refreshpagingL(current_page);
            window.scrollTo(470, 470);
          }
          
        }
        $("#product").html(read_products_html);
      });
    }
    
    function setlinks(page)
    {
        $("#first_p").on("click",function()
        {
          if(page <=max_page){
          current_page = page;window.scrollTo(470, 470);
          
            cleanP();showProducts(page);$("#first_p").parent()[0].setAttribute("class","active");
          }
        });
        $("#second_p").on("click",function()
        {
          if(page+1 <=max_page){
          current_page = page+1;window.scrollTo(470, 470);

          cleanP();showProducts(page+1);$("#second_p").parent()[0].setAttribute("class","active");
          }
        });
        $("#third_p").on("click",function()
        {
          if(page+2 <=max_page){
          current_page = page+2;window.scrollTo(470, 470);

          cleanP();showProducts(page+2);$("#third_p").parent()[0].setAttribute("class","active");
          }
        });
        $("#fourth_p").on("click",function()
        {
          if(page+3 <=max_page){
          current_page = page+3;window.scrollTo(470, 470);

          cleanP();showProducts(page+3);$("#fourth_p").parent()[0].setAttribute("class","active");
          }
        });
        $("#fifth_p").on("click",function()
        {
          if(page+4 <=max_page){
          current_page = page+4;window.scrollTo(470, 470);

          cleanP();showProducts(page+4);$("#fifth_p").parent()[0].setAttribute("class","active");
          }
        });
    }
    function refreshnumeric(page)
    {
        $("#first_p").html(page);
        $("#second_p").html(page+1);
        $("#third_p").html(page+2);
        $("#fourth_p").html(page+3);
        $("#fifth_p").html(page+4);
    }
    let newpage = true;
    function cleanP()
    {
          $("#first_p").parent()[0].setAttribute("class","");
          $("#second_p").parent()[0].setAttribute("class","");
          $("#third_p").parent()[0].setAttribute("class","");
          $("#fourth_p").parent()[0].setAttribute("class","");
          $("#fifth_p").parent()[0].setAttribute("class","");
    }
    function refreshpagingL(page)
    {
          cleanP();
          if(page%5==0)
          {
            $("#fifth_p").parent()[0].setAttribute("class","active");
            refreshnumeric(page-4);
            setlinks(page-4);
          }
          if(page%5==1)$("#first_p").parent()[0].setAttribute("class","active");
          if(page%5==2)$("#second_p").parent()[0].setAttribute("class","active");
          if(page%5==3)$("#third_p").parent()[0].setAttribute("class","active");
          if(page%5==4)$("#fourth_p").parent()[0].setAttribute("class","active");
          
      

    }
    function refreshpagingM(page)
    {
          cleanP();
          
          if(page%5==1){
            $("#first_p").parent()[0].setAttribute("class","active");
            if(!newpage){
              newpage = true;
              refreshnumeric(page);
              setlinks(page);
            }
          }
          if(page%5>1)newpage = false;
          if(page%5==2)$("#second_p").parent()[0].setAttribute("class","active");
          if(page%5==3)$("#third_p").parent()[0].setAttribute("class","active");
          if(page%5==4)$("#fourth_p").parent()[0].setAttribute("class","active");
          if(page%5==0)$("#fifth_p").parent()[0].setAttribute("class","active");

    }
    </script>
    <style>
      
      #elements
      {
      	height:2600px;
      }
      
      @media (max-width: 767px) {
        #elements
        {
      	    height:7550px;
        }
      }

      #curtains
      {
        width:100%;
        height:100%;
        position:fixed;
        top:0;
        display: none;
        z-index: 999;
        background-color: black;
        opacity: 0.2;
      }
    </style>
<div style="text-align:center;">
<div style="max-width:2000px">
<div id="curtains"></div>


    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new arrivals</h4>
              <h2>sixteen products</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="row" style="
                        width: 100%;
                        margin: 0;">
  <div id = "left" class="col-lg-3" style="margin-top:15px;padding-left: 35px;border: 1px solid #eee;">
    <div id = "mb_filter" style="display:flex;justify-content:space-between;align-items:center;">
      <button type="button" id = "sm_filter">
        <span id="text_for_sm_filter">Filter</span>
         ☛
      </button>
    </div>
    <div id = "filter">
    <!-- shop-filter start -->
      <div class="shop-filter">
        <div id = "close" style="margin-bottom:30px">
          <img width = 25px height = 25px src="{{asset('assets/images/close.png')}}" alt="close">
        </div>
        <div class="area-title">
          <h3 class="title-group gfont-1">Filters Products</h3>
        </div>

        <h4 class="shop-price-title">Price</h4>
        <div class="info_widget">
          <div class="price_filter">
            <div id="slider-range"></div>
            <div class="price_slider_amount">	
              <div class="lbl_for_number">
                <span>from</span>
                <span>before</span>
              </div>
              <div style="text-align:center">
                <input type="number" id="amount_start" name="price"  placeholder="Add Your Price" />
                <input type="number" id="amount_end" name="price"  placeholder="Add Your Price" />
              </div>					
            </div>
          </div>
        </div>

        <h4 class="shop-price-title">Whole Price</h4>
        <div class="info_widget">
          <div class="price_filter">
            <div id="slider-range_whole"></div>
            <div class="price_slider_amount">	
              <div class="lbl_for_number">
                <span>from</span>
                <span>before</span>
              </div>
              <div style="text-align:center">
                <input type="number" id="amount_start_whole" name="price"  placeholder="Add Your Price" />
                <input type="number" id="amount_end_whole" name="price"  placeholder="Add Your Price" />
              </div>					
            </div>
          </div>
        </div>

        <div>
          <h4 class="shop-price-title">Number Of Whole</h4>
          <input type="number" style="margin-top:10px">

          <br>
          <?$id=0?>
          @foreach ($characteristic->get_characteristics as $item)
          <details class="settings" id="{{$item['id']}}">
            <summary style="outline:none;user-selected:none">
              <h5>{{$item['description']}}</h5>
            </summary>
                <div>
                  <div class="filter-menu">
                    <ul>
                      <?
                      $values = array();
                      foreach($item->get_values()->get() as $tmp)
                      {
                        $values[] = $tmp->value;
                      }
                      $values = array_unique($values);
                      ?>
                      @foreach ($values as $value)
                        <?++$id?>  
                        <li class="setting">
                      
                          <input 
                            style = "margin-right:10px;margin-left:20px"
                            type="checkbox"
                            value = {{$value}}
                            id="ch{{$id}}"
                            class="{{$item->name}}">

                           <label for="ch{{$id}}">{{$value}}</label>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
           </details>
            
          @endforeach

          <input type="button" id = "filter_btn" name = "filter" value="Filter" style="margin-top:10px"/>
        </div>
      </div>
    </div>
    <!-- shop-filter start -->
  </div>

<div class="col-md-12 col-lg-9" id = "main-container">
    <div class="products">
      <div class="container">
        <div class="row">
          <div class="col-md-12" id = "elements">
            <div class="filters-content">
                <div class="row grid" id = "product">
                    
                </div>
            </div>
          </div>
          <div class="col-md-12">
            <ul class="pages">
              <li><a id = "prev_page"><i class="fa fa-angle-double-left"></i></a></li>
              <li class = "active"><a id = "first_p">1</a></li>
              <li><a id = "second_p">2</a></li>
              <li><a id = "third_p">3</a></li>
              <li><a id = "fourth_p">4</a></li>
              <li><a id = "fifth_p">5</a></li>
              <li><a id = "next_page"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

</div>
</div>

</div>
</div>

<script>
  $("#filter_btn").on("click",function(){
    let settings_array = {}; 
    for (let element of $(".settings")) {
      let arraychecks = [];
      for(let checkbox of $(element).find("input[type=checkbox]"))
      {
        if(checkbox.checked)arraychecks.push($(checkbox).val());
      }
      settings_array[$(element).attr("id")] = arraychecks;
      console.log(settings_array);  
    }
    json = 
    {
      'api_token'    :  api_token,
      'price_start'  :  $("#amount_start").val(),
      'price_end'    :  $("#amount_end").val(),
      'settings'     :  settings_array
    };
    showProducts(1);
  });

</script>
<script src="{{asset('assets/js/lightslider.js')}}"></script>
    <script>
      setlinks(current_page);
    </script>
    <script>
      let min = 40;
      let max = 600;
      /*------------------------
      choose text price
      --------------------------
      */
      $("#amount_start, #amount_end").on("change",function()
      {
        if( !isNaN(Number($(this).val()))){
          if(Number($(this).val())>min 
          && Number($(this).val())<max 
          && $("#amount_end").val() >= $("#amount_start").val()){
            $( "#slider-range" ).slider( "option", "values",
              [ Number($("#amount_start").val()), Number($("#amount_end").val()) ] );
          }
          else if($(this).attr("id") == "amount_start"){
            $( "#slider-range" ).slider("values",
              0,min);
            $(this).val(min);
          }
          else if($(this).attr("id") == "amount_end")
          {
            $( "#slider-range" ).slider("values",
              1,max);
            $(this).val(max);
          }
        }
      });

      /*------------------------
      choose text whole_price
      --------------------------
      */
      $("#amount_start_whole, #amount_end_whole").on("change",function()
      {
        if( !isNaN(Number($(this).val()))){
          if(Number($(this).val())>min 
          && Number($(this).val())<max 
          && $("#amount_end_whole").val() >= $("#amount_start_whole").val()){
            $( "#slider-range_whole" ).slider( "option", "values",
              [ Number($("#amount_start_whole").val()), Number($("#amount_end_whole").val()) ] );
          }
          else if($(this).attr("id") == "amount_start_whole"){
            $( "#slider-range_whole" ).slider("values",
              0,min);
            $(this).val(min);
          }
          else if($(this).attr("id") == "amount_end_whole")
          {
            $( "#slider-range_whole" ).slider("values",
              1,max);
            $(this).val(max);
          }
        }
      });

      /*---------------------
      whole price slider
      --------------------- */  
      $(function() {
          $( "#slider-range_whole" ).slider({
           range: true,
           min: min,
           max: max,
           values: [ min, max ],
           slide: function( event, ui ) {
            $( "#amount_start_whole" ).val(ui.values[ 0 ]  );
            $( "#amount_end_whole" ).val(ui.values[ 1 ] );
           }
           
          });
          $( "#amount_start_whole" ).val($( "#slider-range_whole" ).slider( "values", 0 ) );
          $( "#amount_end_whole" ).val($( "#slider-range_whole" ).slider( "values", 1 ) );
        });	
      /*---------------------
       price slider
      --------------------- */  
        $(function() {
          $( "#slider-range" ).slider({
           range: true,
           min: min,
           max: max,
           values: [ min, max ],
           slide: function( event, ui ) {
            $( "#amount_start" ).val(ui.values[ 0 ]  );
            $( "#amount_end" ).val(ui.values[ 1 ] );
           }
           
          });
          $( "#amount_start" ).val($( "#slider-range" ).slider( "values", 0 ) );
          $( "#amount_end" ).val($( "#slider-range" ).slider( "values", 1 ) );
        });	
      
        /*--------------
        curtains click
        ---------------*/
        $("#curtains").on("click",function(){
          $('#filter').hide(1000);
          $(this).hide();
        });
        // делаете переменную в начале кода
          let isMobile = false;
          let isready = false;

          function mobile_screen(){
              if (window.innerWidth-15 <= 991) {
                  isMobile = true;
              }
              else isMobile = false;

              if (isMobile && !isready) {
            $(document).scroll(function(event)
            {
              if(($("#mb_filter").offset().top) - (document.documentElement.scrollTop) < 65)
              {
                $("#text_for_sm_filter").html("");
                $("#sm_filter").css({"position":"fixed","top":"90px","z-Index":100,"border-radius": "50%","height":"65px","width":"65px"});
              }
              else
              {
                $("#text_for_sm_filter").html("Filter");
                $("#sm_filter").css({"position":"static","border-radius": "10px","height":"57px","width":"120px"});
              }
            })	
            isready = true;

            $('#filter').hide();
            $('#mb_filter').show();
      
            $('#close').on("click",function()
            {
              $('#filter').hide(1000);
              $("#curtains").hide();
            })
      
            $('#amount').css({"display":"block","width":"100%"});
            $('#subprice').css({"display":"block","margin-top":"15px"});
            
      
            $('#left').removeAttr('class');
            $('#filter').css({"position":"fixed",
                              "top":"70px",
                              "padding":"20px",
                              "background-color":"white",
                              "overflow": "scroll",
                              "width":"300px",
                              "height":"100%"});
            $("#curtains").css({"left":$('#filter').css("width")});
      
            $(".filter-menu").css({"font-size":"15px"})
            $('#sm_filter').on("click",function()
            {
              $('#filter').toggle(1000);
              $("#curtains").show();
            })
              }
              // или для остальных
              if (!isMobile) {
                  isready = false;
                  $('#left').attr("class","col-md-3");
                  $("#filter").removeAttr( 'style' );
                  $('#filter').show();
                  $('#mb_filter').hide();
                  $('#close').hide();
              }
          } 
          mobile_screen();
          $(window).resize(mobile_screen);
      </script>
@endsection
