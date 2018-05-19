@extends('admin/admin_template')

@section('content')


<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        @if (Session::has('success'))
		<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success !</h4>
            {!! session('success') !!}
        </div>
		@endif
        <!-- PRODUCT LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">( Total : {{ count($model) }} ) </h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-danger" href="{{url('admin/content/create')}}?type=<?php echo $type; ?>">Add new <?php echo $type; ?> template</a>


                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">

                    <?php $i = 1; ?>
                    @foreach ($model as $row)

                    <?php
                    $color = ($i % 2 == 0 ? 'success' : 'info');
                    ?>

                    <li class="item">
                        <div class="product-img">
                            <br />
                            <a href="content/delete/<?php echo $row->id ?>">Delete</a>

                        </div>

                        <div class="product-info">
                            <a href="content/edit/<?php echo $row->id ?>" class="product-title"><?php echo $row->title; ?>
                                <span class="label label-<?php echo $color; ?> pull-right"><?php echo $row->created_at; ?></span></a>
                            <span class="product-description">
                                <?php //echo $row->teaser; ?>
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
                <a href="javascript::;" class="uppercase"></a>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->	

@endsection