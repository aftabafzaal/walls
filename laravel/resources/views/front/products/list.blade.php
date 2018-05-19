<?php
$currency= Config::get('params.currency');
?>
@if(count($products)>0)
<ul class="product-list">
@foreach ($products as $product)


<li>
  <div class="product-img"> <img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image; ?>" alt="<?php  echo $product->name; ?>" />
     <a class="hover-link" href="<?php echo url('product/'.$product->id);?>">View</a> </div>
  <div class="prod-descrp"> <span class="product-name"><?php echo $product->name;?> 
    </span> <span class="prod-price"><?php echo $currency[Config::get('params.currency_default')]['symbol']?> @include('front/products/price')</span> <a href="<?php echo url('product/'.$product->id);?>" class="view-cat-link">Add to cart</a> </div>
</li>
@endforeach
</ul>
@else
 <div class="warning">Sorry, there is no results for your search</div>
@endif