@extends('layouts.main')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
@section('content');

<style>
    #center
    {
        display:flex;
        justify-content: center;
    }
    .element-container
    {
        width:300px;
        height:420px;
        margin:5px;
        border:3px solid coral;
    }
    .element-container>a
    {
        user-select: none;
    }
    .content{
        max-width:1000px;
        display:flex;
        justify-content: center;
        flex-wrap: wrap;

    }
    .element-text
    {
        height:60px;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size:22px;
        display:flex;
        justify-content: center;
        align-items: center;
    }
</style>

@include('index_items.banner')

<div id="center">
        <div class="content">
            <div class="col-md-12" style="margin-top:20px;">
                <div class="section-heading">
                  <h2>Categories</h2>
                </div>
              </div>
            @foreach ($categories as $item)
                <div class ="element-container">
                    <a href="{{asset("/products?category=$item->id")}}">
                        <div height="360px" width="100%">
                            <img height= "360px" width="100%" src = "{{$item->nameimg}}" alt="">
                        </div>
                        <p class="element-text">
                            {{$item->capture}}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>

</div>


@endsection