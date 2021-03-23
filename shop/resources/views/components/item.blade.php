
 <!--START PRODUCT ITEM-->
        <div class="product-item" style = "height:600px">
          <a href="#"><img src="{{asset($mainimg)}}" height="350px" alt="not found"></a>
          <div class="down-content">
            <a href="#"><h4 style = "margin-right:60px;height:40px;overflow: hidden;">{{$title}}</h4></a>
            <h6>{{$price}}</h6>
            <p style = "height:90px;overflow: hidden; text-overflow: ellipsis;">{{$description}}</p>
            <ul class="stars">
              @for ($i = 0; $i < $mark; $i++)
                <li><i class="fa fa-star"></i></li>
              @endfor
            </ul>
            <span>Reviews({{$reviews}})</span>
          </div>
        </div>

  <!--END PRODUCT ITEM-->