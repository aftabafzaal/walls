@extends('admin/admin_template')

@section('content')
   

<!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
  <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Categories( Total : {{ count($attributes) }} ) </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
				
				<?php $i=1; ?>
				@foreach ($attributes as $row)
				
				<?php	
					$color = ($i % 2 ==0 ? 'success' : 'info'); 					
				?>
				
			    <li class="item">
                    <div class="product-img">
                    <a href="attributes/edit/<?php echo $row->id?>" class="product-title"><?php  echo $row->name; ?>
                    <br />
                    <a href="attributes/delete/<?php echo $row->id?>">Delete</a>
                 
                 <?php 
                 if($row->type!='textfield')
                 {
                 ?>
                 |
                 <a href="attributes/values/<?php echo $row->id?>">Manage Values</a>
                 <?php 
                 }
                 ?>
                 
                 </div>
                 <div class="product-info">
                    <span class="label label-<?php echo $color; ?> pull-right"><?php  echo $row->type; ?></span></a>
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