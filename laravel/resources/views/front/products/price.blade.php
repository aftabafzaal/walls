<?php
$currency= Config::get('params.currency');
?>
@if($product->sale==1 && $product->price>$product->salePrice)
<?php
$price=$product->salePrice;
?>

    <span id="old_price" style="text-decoration: line-through;"><?php echo $currency[Config::get('params.currency_default')]['symbol']?><?php echo $product->price?></span>    
    <span id="price"><?php echo $currency[Config::get('params.currency_default')]['symbol']?><?php echo $price?></span>
    @else
    <?php
$price=$product->price;
?>
    <?php echo $currency[Config::get('params.currency_default')]['symbol']?><span id="price"><?php echo $price?></span>
@endif