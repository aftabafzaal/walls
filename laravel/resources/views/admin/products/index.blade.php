@extends('admin/admin_template')

@section('content')


<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Search</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::model($search,array( 'class' => 'form','url' => 'admin/products', 'method' => 'get')) !!}
                <div class="form-group">
                    {!! Form::label('name') !!}
                    {!! Form::text('keyword', null , array('class' => 'form-control','required') ) !!}
                </div>
                 <div class="col-md-12">
                     <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">search</button></div>
                    <div class="col-md-4">
                    <a href="{{url('admin/products')}}/?type=<?php echo $type;?>" class="btn btn-danger btn-block btn-flat">Clear Search</a></div>
                </div>
                {!! Form::hidden('type',$type) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- PRODUCT LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Products( Total : {{ count($products) }} ) </h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-danger" href="{{url('admin/products/create')}}?type=<?php echo $type; ?>">Add new <?php echo $type; ?> product</a>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">

                    <?php $i = 1; ?>
                    @foreach ($products as $row)

                    <?php
                    $color = ($i % 2 == 0 ? 'success' : 'info');
                    ?>

                    <li class="item">
                        <div class="product-img">
                            <img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $row->image; ?>" alt="<?php echo $row->name; ?>" />
                            <br />
                            <a href="products/delete/<?php echo $row->id ?>">Delete</a>
                        </div>

                        <div class="product-info">
                            <a href="products/edit/<?php echo $row->id ?>" class="product-title"><?php echo $row->name; ?>
                                <span class="label label-<?php echo $color; ?> pull-right"><?php echo $row->type; ?></span></a>
                            <span class="product-description">
                                <?php echo $row->teaser; ?>
                            </span>

                        </div>
                    </li>
                    <!-- /.item -->
                    <?php $i++; ?>
                    @endforeach

                </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <?php
                $querystringArray=array();
                
                if(isset($search['keyword'])) {
                    $querystringArray['keyword'] = $search['keyword'];
                }
                echo $products->appends($querystringArray);
                ?>

            </div>
            <!-- /.box-footer -->
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->	

@endsection