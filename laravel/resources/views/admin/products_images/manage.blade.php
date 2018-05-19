@extends('admin/admin_template')

@section('content')



<div class="row">
    <div class="col-md-12">
    
     <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">( Total : {{ count($model) }} ) </h3>

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
				@foreach ($model as $row)
				
                
				<?php	
                //d($row,1);
					$color = ($i % 2 ==0 ? 'success' : 'info'); 					
				?>
				
			    <li class="item">
                <?php 
                //echo asset('uploads/products_images/thumbnail').'/'.$row->image; 
                ?>
                    <div class="product-img">
                    <img src="{{ asset('uploads/products_images/thumbnail')}}/<?php echo $row->image; ?>" alt="<?php  echo $row->caption; ?>" />
                    <a href="#_" class="product-title"><?php  echo $row->name; ?></a>
                    <br />
                   <a href="../delete/<?php echo $row->id?>/<?php echo $product_id?>">Delete</a>
                 
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
      <!-- Horizontal Form -->
      <!-- /.box -->
      <!-- general form elements disabled -->
      <div class="box box-warning">
      @if (Session::has('success'))
		<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success !</h4>
            {!! session('success') !!}
        </div>
		@endif
        <div class="box-header with-border">
          <h3 class="box-title">Manage Images</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
           {!! Form::open(array( 'class' => 'form','url' => 'admin/productsimages/insert', 'files' => true)) !!}
            <!-- text input -->
            <div class="form-group">
                {!! Form::label('Color') !!}
	 		    {!! Form::select('attribute_value_id', [""=>"No Attribute"]+$colors,null,array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('image') !!}
                {!! Form::file('image', null,array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
            </div>
            {!! Form::hidden('product_id',$product_id) !!}
          {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>

@endsection