@extends('admin/admin_template')

@section('content')
<?php 
$currency= Config::get('params.currency');
$orderPrefix= Config::get('params.order_prefix');
?>
<section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Sales</span>
              <span class="info-box-number">{{ $totalSales }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pending Sales</span>
              <span class="info-box-number">{{ $totalPendingSales }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">{{ $totalSuccessSales }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">{{ $totalUsers }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
        
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
              </div>
            </div>
            <!-- /.box-header -->
            <?php if(isset($recentOrders) && !empty($recentOrders)){?>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <td>Added</td>
                     <th>Status</th>
                      <th>Total</th>
                    	
                    
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($recentOrders as $key=>$val){
                    ?>
                    <tr>
                        <td><a href="{{url('admin/order')}}<?php echo '/'.$val->id; ?>"><?php echo $orderPrefix.$val->id?></a></td>
                        <td><?php echo $val->firstName.' '.$val->lastName; ?></td>
                        <td><?php echo $val->email; ?></td>
                        <td>{{ date('d M Y',strtotime($val->created_at))}}</td>
                        <td><?php echo $val->orderStatus; ?></td>
                        <td><?php echo $val->grandTotal; ?></td>
                        
                  </tr>
                  
                 <?php } ?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <?php } ?>
            <div class="box-footer clearfix">
              <a href="{{url('admin/orders')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
        
<?php if(isset($products) && !empty($products) ) {?>
          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Test</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
              <?php foreach($products as $key=>$val){ ?>
               <!-- /.item -->
                <li class="item">
                  <div class="product-info">
                    <a href="<?php echo 'products/edit/'.$val->id; ?>" class="product-title"><?php echo $val->name; ?>
                      <span class="label label-info pull-right">{{$currency[Config::get('params.currency_default')]['symbol']}}<?php echo $val->price; ?></span></a>
                        <span class="product-description">
                          <?php echo $val->description; ?>
                        </span>
                  </div>
                </li>
                <?php } ?>
                
               
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ 'products' }}" class="uppercase">View All Products</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
          <?php } ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection