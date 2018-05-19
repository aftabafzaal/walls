<?php
$required = "required";
?>
@include('admin/commons/errors')
<div class="form-group">
    {!! Form::label('name') !!}
    {!! Form::text('name', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('code') !!}
    {!! Form::text('sku', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('key') !!}
    {!! Form::text('key', $key , array('class' => 'form-control',$required) ) !!}
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"> {!! Form::label('categories') !!} </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <ul class="products-list product-list-in-box" id="tree1">
                <?php
                $i = 1;
                foreach ($categories as $id => $category) {
                    ?>
                    <div class="col-md-4">
                        <li><input type="checkbox" class="checkall" id="<?php echo $id; ?>"/><?php echo '-' . $category['name']; ?>

                            <ul>
                                <?php
                                if (!empty($category['categories'])) {

                                    foreach ($category['categories'] as $subCatId => $subCategory) {
                                        $check = false;

                                        if (!empty($productsCategories) && in_array($subCatId, $productsCategories)) {
                                            $check = true;
                                        }
                                        ?>
                                        <li>{!! Form::checkbox('categories[]', $subCatId,$check,array('class'=>'sub_cat_'.$id)) !!} 
                                            {!! Form::label('sub_cat_'.$subCatId, $subCategory) !!}</li>
                                        <?php
                                    }
                                } else {
                                    echo "<li>no categories</li>";
                                }
                                ?>
                            </ul></li> </div>  
                    <?php
                    if ($i == 3) {
                        echo "<br clear='all'/>";
                        $i = 0;
                    }
                    $i++;
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<br clear='all'/><br clear='all'/>
<div class="form-group">
    {!! Form::label('Short Description') !!}
    {!! Form::text('teaser', null , array('class' => 'form-control') ) !!}
</div>

<div class="form-group">
    {!! Form::label('description') !!}
    {!! Form::textarea('description', null, ['size' => '105x3','class' => 'form-control ckeditor',$required]) !!} 
</div>

<div class="form-group">
    {!! Form::label('requirments') !!}
    {!! Form::textarea('requirments', null, ['size' => '105x3','class' => 'form-control ckeditor']) !!} 
</div>

<div class="form-group">
    {!! Form::label('price') !!}
    {!! Form::text('price', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('Price For Doctors') !!}
    {!! Form::text('priceForDoctors', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::checkbox('sale',1,false,['id'=>'sale']); !!}
    Sale This Product. 
</div>

<div class="form-group">
    {!! Form::label('Sale Price') !!}
    {!! Form::text('salePrice', null , array('class' => 'form-control') ) !!}
</div>

<div class="form-group">
    {!! Form::label('keywords') !!}
    {!! Form::text('keywords', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('image') !!}
    {!! Form::file('image', null,array($required,'class'=>'form-control')) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
</div>

<script>
    $(document).ready(function () {
        $('.checkall').on('change', function () {
            $(".sub_cat_" + this.id).prop('checked', $(this).prop('checked'));
        });
    });
</script>