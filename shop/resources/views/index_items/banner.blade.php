
  <div class="banner header-text">
    <div class="owl-banner owl-carousel">
      <!--items of banner-->
      @foreach ($banners as $item) 
        <div class="banner-item" style = "background-image: url({{asset("$item->img")}})">
          <div class="text-content">
            <h4>{{$item->name}}</h4>
            <h2>{{$item->alias}}</h2>
          </div>
        </div>
      @endforeach
      <!--end items of banner-->
    </div>
  </div>