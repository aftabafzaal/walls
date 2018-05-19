@extends('admin/admin_template')
@section('content')

<!-- Main row -->
<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Categories( Total : {{ count($categories) }} ) </h3>
            </div>
            <div class="box-body">
                <ul class="products-list product-list-in-box">

                    <?php $i = 1; ?>
                    @foreach ($categories as $row)

                    <?php
                    $color = ($i % 2 == 0 ? 'success' : 'info');
                    ?>

                    <li class="item">

                        <div class="product-img">
                            <img src="{{ asset('uploads/categories/thumbnail')}}/<?php echo $row->image; ?>" alt="<?php echo $row->name; ?>" />
                            <br clear="all" />
                            <a class="btn btn-warning" href="categories/edit/<?php echo $row->id ?>">Edit</a>
                            <!--
                            <a  class="btn btn-danger" href="categories/delete/<?php echo $row->id ?>">Delete</a>
                            -->
                        </div>

                        <div class="product-info">
                            <?php echo $row->name; ?>
                                <span class="label label-<?php echo $color; ?> pull-right"><?php echo $row->type; ?></span>                            <span class="product-description">
                                <?php echo $row->teaser; ?>
                            </span>

                        </div>
                    </li>
                    <!-- /.item -->
                    <?php $i++; ?>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>
</div>
<!-- /.row -->	

@endsection
