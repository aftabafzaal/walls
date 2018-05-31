@extends('front')
<?php
$title = 'Shop';
$description = '';
$keywords = '';

$currency = Config::get('params.currency');
?>

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
                    
                    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-4">
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