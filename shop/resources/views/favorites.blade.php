@extends('layouts.main')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
@section('content');
<input id = "url" type="text" hidden value = "{{asset('/product')}}">
<input id = "token" type="text" hidden value = "{{$token}}">
<style>
  .pages
  {
    user-select: none;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    let current_page = 1;
    let max_page =1;
    let token = $('#token').val();
    let link ='http://127.0.0.1:8000/api/favorites';
    showProducts(current_page);
    // здесь будет метод showProducts()
    function showProducts(i){
        // получить список товаров из API
        $.post(link,{ api_token:token,
        page:i}, function(data){
            max_page = data.last_page;
            read_products_html ="";
            //let i = 0;
            $.each(data.data, function(key, val) {
                //i++;
            // создание новой строки таблицы для каждой записи 
            read_products_html+=
                `
                <div class="col-lg-4 col-md-4 all des">
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
            
            },'json');
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
    </style>
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

    
    <div class="products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="filters">
              <ul>
                  <li class="active" data-filter="*">All Products</li>
                  <li data-filter=".des">Featured</li>
                  <li data-filter=".dev">Flash Deals</li>
                  <li data-filter=".gra">Last Minute</li>
              </ul>
            </div>
          </div>
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
    <script>
      setlinks(current_page);
    </script>
@endsection

{{-- @extends('layouts.main')

@section('content')

<style>
    .delete_buy
    {
        font-size:18px;
        color:white;
        background-color:#FF2627;
        display:inline;
        padding:4px;
        border-radius: 5px;
        margin-right:3px;
    }
</style>

<div class="latest-products">
    <div class="container">
      <div class="row">
       @foreach ($products as $item)
       <div class="col-md-4" style = "height:658px;padding-top:38px">
          
          <div class = "sub" style = "padding-bottom:3px;display:flex;justify-content:left">
            <div class = "delete_buy">
               delete
            </div>
            <div class = "delete_buy">
               buy
            </div>
          </div>
          {{(new App\View\Components\item($item))->render()}}
       </div>
       @endforeach
      </div>
    </div>
</div>    
<script>
  $(".col-md-4").find(".sub").hide();
   $(".col-md-4").on("mouseleave",function()
   {
       $(this).css("padding-top","38px")
       $(this).find(".sub").hide();
   });
   $(".col-md-4").on("mouseover",function()
   {
       $(this).css("padding-top","0px")
       $(this).find(".sub").show();
   });
</script>
@endsection --}}