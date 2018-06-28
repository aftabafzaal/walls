@extends('front')
<?php
$title = $model->metaTitle;
$description = $model->metaDescription;
$keywords = $model->keywords;
?>
@include('front/common/meta')
@section('content')






<section class="slider-area no-ctrl " >
    <div id="carousel-example-generic" class="carousel slide slider--pauseplay">

        <ol class="carousel-indicators thumbs">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <span class="pins">
            <span class="pin pin1"><img src="{{ asset('front/images/pin2.png') }}" alt="" /></span>
            <span class="pin pin2"><img src="images/pin1.png" alt="" /></span>

        </span>

        <div class="carousel-inner  bg-cvr" style='background-image:url("{{ asset('front/images/slider-bg.png') }}")'>


            <div class="item active bg-cntr" style="background-image:url('{{ asset('front/images/slide1.jpg') }}');">

                <div class="container">
                    <div class="caro-cap">

                        <h2>Eid ki khushiyan</h2>
                        <h2>Karain double</h2>
                        <img src="{{ asset('front/images/slide-caption.png') }}" />
                        <h2>Kay sath!</h2>
                    </div>


                    <div class="slide_bottom bg-cvr anime-up" style="background-image:url('images/slide-wood.png')">
                        <img class="anime-right delay1s" src="{{ asset('front/images/slide-icecream.png') }}" alt="" />
                    </div>
                </div>

            </div>

        </div>

        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>

    </div>

</section>


<section class="banner-area bg-cvr" style="background-image:url('{{ asset('front/images/banner-bg.png') }}')">
    <div class="container">
        <span class="pin"><img src="{{ asset('front/images/pin3.png') }}" /></span>
        <img src="{{ asset('front/images/banner.png') }}" alt="" />

    </div>
</section>

<section class="feat-area">
    <div class="container" id="featured_products" ></div>
</section>

<section class="popular-area">
    <div class="container" id="popular_products" ></div>
</section>


<section class="bundles-area   ">
    <div class="container" id="bundle_products"></div>
</section>
@endsection