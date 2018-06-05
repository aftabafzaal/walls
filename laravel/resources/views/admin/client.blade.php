@extends('admin/admin_template')

@section('content')
<?php
$currency = Config::get('params.currency');
$orderPrefix = Config::get('params.order_prefix');
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-6 col-md-6 col-md-6">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Customer's Information</h3>
                    </div>
                    <div class="row">
                        <ul>
                            <li>First Name :{{ $data[0]->firstName }}</li>
                            <li>Middle Name :{{ $data[0]->middleName }}</li>
                            <li>Last Name :{{ $data[0]->lastName }}</li>
                            <li>Gender :{{ ($data[0]->gender=='m') ? 'Male' : 'Female' }}</li>
                            <li>Date of Birth :{{ $data[0]->dob }}</li>
                            <li>Email:{{ $data[0]->email }}</li>
                            <li>Joins:{{ $data[0]->created_at }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-md-6">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Address Information</h3>
                        <div class="box-tools pull-right">
                            <?php if($data[0]->role_id==2){?>
                            <a class="btn btn-info" href="{{url("admin/user/make-manager")}}/<?php echo $data[0]->id;?>"> Make Area manager</a>
                            <?php }elseif($data[0]->role_id==3){ ?>
                            <a class="btn btn-info" href="{{url("admin/user/remove-manager")}}/<?php echo $data[0]->id;?>"> Remove as Area manager</a>
                            <?php }?>
                        </div> 
                    </div>
                    <div class="row">
                        <ul>
                            <li>Address:{{$data[0]->address }}</li>
                            <li>Address 2:{{$data[0]->address2 }}</li>
                            <li>Phone:{{$data[0]->phone }}</li>
                            <li>Mobile:{{$data[0]->mobile }}</li>
                            <li>Country:{{ $data[0]->country }}</li>
                            <li>State:{{$data[0]->state }}  </li>
                            <li>City:{{$data[0]->city }}</li>
                            <li>Zip Code:{{$data[0]->zip }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- PRODUCT LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">( Total Orders : {{ isset($orders)?count($orders):0 }} ) </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <?php if (isset($orders) && !empty($orders)) { ?>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">

                        <table class="table" id="order_table">
                            <thead>
                                <tr>
                                    <td>Order Id</td>
                                    <td>Name</td>
                                    <td>Added</td>
                                    <td>Status</td>
                                    <td>Total</td>
                                    <td></td>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><?php echo $orderPrefix; ?>{{$order->id}}</td>
                                    <td>{{ $order->firstName.' '.$order->lastName }}</td>
                                    <td>{{ date('d M Y',strtotime($order->created_at))}}</td>
                                    <td>{{ ucfirst($order->orderStatus)}}</td>
                                    <td>{{ $currency[Config::get('params.currency_default')]['symbol']}}{{ $order->grandTotal}}</td>
                                    <td><a href="{{ url('admin/order')}}/{{$order->id}}">Detail</a></td>                                    
                                </tr>
                                @endforeach 
                            </tbody>

                        </table>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
@endsection