@extends('front')
<?php
$title = 'Shop';
$description = '';
$keywords = '';

$currency = Config::get('params.currency');
?>
<style>

    
    .img-wrap-tailor a{display:block}
    .img-wrap-tailor{    width: 100%;
                         float: left;
                         overflow: hidden;
                         height: 300px;
                         position: relative;}
    .img-wrap-tailor span{    position: absolute;
                              background: #ff6600;
                              width: 100%;
                              left: 0;
                              bottom: 0;
                              text-align: center;
                              padding: 5px 0;
                              font-size: 19px;
                              color: #fff;}
    .box-customn{    width: 100%;
                     float: left;
                     border: 1px solid #ccc;
                     margin: 15px 0;box-shadow:0 0 5px #000;}
    .box-customn .imfo-area{width:100%; float:left;text-align:center;}
    .box-customn .imfo-area h3{    margin: 0px;
                                   padding: 0px;
                                   color: #0c0c0c;
                                   font-size: 21px;
                                   line-height: 30px;
                                   font-weight: 600;
                                   text-transform: uppercase;}
    .box-customn .imfo-area p{margin: 0px;padding:5px 0px;font-size:14px;}
    .box-customn .imfo-area h4{color: #ff0000;
                               font-weight: bold;
                               line-height: 30px;
                               font-size: 25px;}
    .img-wrap-tailor img{max-width:100%;}
    .box-customn a.onhover{display:none;}
    .box-customn:hover a.onhover{display:block;position:absolute;top:0px;left:0px;}
    .box-customn:hover a.nohover{display:none;}
</style>
@include('front/common/meta')
@section('content')
<section class="test-bd-area pt50 pb50" >
    <div class="container">
        <p>Traditionally to order a lab test you have to make an appointment to see your doctor, wait in clinic waiting room with other sick patients, pay your copay, pay the doctors fee and get a surprise bill in the mail, why would you want to go through the stress?  Browse our test menu and order on demand, on your terms, it’s the 21st century.</p>
        <div class="test-menu-area table-responsive0">

            <h3>Shop</h3>

            <style>
                td[colspan] {
                    font-size: 28px;
                }
            </style>

            <div class="container">
                
                    @if(count($products)>0)




                    @foreach ($products as $product)
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="box-customn">
                            <div class="img-wrap-tailor">
                                <a href="<?php echo url('product/'.$product->id);?>"><img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image; ?>" alt="<?php  echo $product->name; ?>" /></a>
                                <span>View</span>
                            </div>
                            <div class="imfo-area">
                                <h3><?php  echo $product->name; ?></h3>
                                <p><?php  echo $product->teaser; ?></p>
                                <h4> @include('front/products/price')</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    @else
                    <div class="warning">Sorry, there is no results for your search</div>
                    @endif

            </div>
        </div>
    </div>
</section>          


@endsection