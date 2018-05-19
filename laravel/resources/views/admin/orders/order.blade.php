@extends('admin/admin_template')
@section('content')
<?php
$currency = Config::get('params.currency');
$orderPrefix = Config::get('params.order_prefix');
?>
@include('admin/commons/errors')
<div class="row">
    <div class="col-lg-12 col-md-12">

        <div class="box box-primary">

            <div class="box-body">
                <div class="col-lg-6 col-md-6 col-md-6">
                    <div class="box-header with-border">
                        <h2 class="box-title">Order Information</h2>
                    </div>
                    <ul class="products-list product-list-in-box" >
                        <li><strong>Order ID:</strong> <?php echo $orderPrefix; ?>{{$orders->id}}</li>
                        <li><strong>Email:</strong> {{$orders->email}}</li>
                        <li><strong>Order Date:</strong> {{ date("d M Y",strtotime($orders->orderDate))}}</li>
                        <li><strong>Order Total:</strong> {{ $currency[Config::get('params.currency_default')]['symbol']}}{{ $orders->grandTotal}}</li>
                        <li><strong>Order Status:</strong> 
                            <div class="form-group">

                                <select class="form-control"  id="order_status" name="type">
                                    <option <?php echo (isset($orders->orderStatus) && $orders->orderStatus == 'pending') ? 'SELECTED' : ''; ?> value="pending">Pending</option>
                                    <option <?php echo (isset($orders->orderStatus) && $orders->orderStatus == 'processing') ? 'SELECTED' : ''; ?> value="processing">Processing</option>
                                    <option <?php echo (isset($orders->orderStatus) && $orders->orderStatus == 'complete') ? 'SELECTED' : ''; ?> value="complete">Complete</option>
                                    <option <?php echo (isset($orders->orderStatus) && $orders->orderStatus == 'cancelled') ? 'SELECTED' : ''; ?> value="cancelled">Cancelled</option>
                                    <option <?php echo (isset($orders->orderStatus) && $orders->orderStatus == 'closed') ? 'SELECTED' : ''; ?> value="closed">Closed</option>
                                    <option <?php echo (isset($orders->orderStatus) && $orders->orderStatus == 'onhold') ? 'SELECTED' : ''; ?> value="onhold">On Hold</option>
                                </select>
                                <button onclick="updateStatus('<?php echo $orders->id; ?>', $('#order_status').val())" >Update</button>
                                <div id="warning_message" ></div>
                                <div class="loader" style="display: none;">Loading...</div>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-md-6">
                    <div class="box-header with-border">
                        <h2 class="box-title">Patient Information</h2>
                        <div class="box-tools pull-right">
                            <a class="btn btn-danger" href="{{url('admin/order/delete')}}/{{$orders->id}}">Delete</a>
                        </div>

                    </div>
                    <ul>
                        <li>
                            <strong>Name:</strong> {{$orders->patientName}}
                        </li>
                        <li>
                            <strong>Gender:</strong> {{$orders->gender}}
                        </li>
                        <li>
                            <strong>Date of Birth:</strong> {{$orders->dob}}
                        </li>
                        <li>
                            <strong> Country:</strong> {{$orders->country}}
                        </li>
                        <li>
                            <strong>State:</strong> {{$orders->state}}
                        </li>
                        <li>
                            <strong>City:</strong> {{$orders->city}}
                        </li>
                        <li>
                            <strong>Zip:</strong> {{$orders->zip}}
                        </li>
                        <li>
                            <strong>Phone:</strong> {{$orders->phone}}
                        </li>
                    </ul>

                </div>

            </div>
        </div>

    </div>

    <div class="col-lg-12 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Message</h3>
            </div>
            <div class="box-body">
                <?php echo $orders->message; ?>


            </div>

        </div>
    </div>

    <div class="col-lg-12 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Quest Transaction Result</h3>
            </div>
            <div class="box-body">
                <?php echo $quest->response; ?>
            </div>

        </div>
    </div>


    <?php
    if (!empty($ordersDocuments)) {
        ?>
        <div class="col-lg-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">PSC Transaction Result</h3>.
                    <div class="box-tools pull-right">
                        <a target="_blank" class="btn btn-info" href="{{asset('/uploads/quest/orders/documents/')}}/{{$orders->id}}.pdf">View Order File</a>
                    </div>
                </div>
                <div class="box-body">
                    <?php echo $ordersDocuments->response; ?>
                </div>

            </div>
        </div>
    <?php } ?>
    <div class="col-lg-12 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Test Summary</h3>
                <div class="box-tools pull-right">
                    <a target="_blank" class="btn btn-info" href="{{asset('/uploads/quest/orders')}}/{{$orders->id}}.hl7">View Order File</a>
                </div>
            </div>
            <div class="box-body">


                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $i = 0;
                        ?>
                        @foreach ($orders->products as $product)
                        <?php
                        $rowTotal = $product->price * $product->quantity;
                        $sum+=$rowTotal;
                        ?>
                        <tr>
                            <td>
                                <?php echo $product->name; ?>
                            </td>
                            <td><span class="txt-price">{{ $currency[Config::get('params.currency_default')]['symbol']}} <?php echo $product->price ?></span></td>

                        </tr>
                        <?php
                        $i++;
                        ?>
                        @endforeach


                    </tbody>
                </table>
            </div></div>
    </div>


    <div class="col-lg-12 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Results</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-danger" href="{{url('admin/orders/results/')}}/{{$orders->id}}">Add Result</a>
                </div>
            </div>
            <div class="box-body">



                @if(count($results)>0)
                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Result ID</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                        <tr>
                            <td><?php echo $result->id; ?></td>
                            <td>{{ date("d M Y",strtotime($result->created_at))}}</td>
                            <td><a target="_blank" href="{{asset('uploads/orders/results')}}/{{$result->file}}" class="btn-sm btn-info"> View Report</a> | <a  href="{{url('admin/orders/results/edit/')}}/{{$result->id}}" class="btn-sm btn-warning"> Edit</a> | <a href="{{url('admin/orders/results/delete/')}}/{{$result->id}}" class="btn-sm btn-danger"> delete</a> </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
                @else
                <div class="alert alert-danger alert-dismissible">No result uploaded yet.</div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function updateStatus(order, status)
    {
        $("#warning_message").html('');
        $('.loader').css('display', 'block');
        $("#warning_message").html('');

        var CSRF_TOKEN = "{{ csrf_token() }}";
        $.ajax({
            url: '{{ url("admin/order/updateOrderStatus") }}',
            type: 'POST',
            data: {_token: CSRF_TOKEN, orderid: order, status: status},
            dataType: 'JSON',
            success: function (data) {
                $('.loader').css('display', 'none');
                if (data.success == 1)
                {
                    $("#warning_message").html('<div class="alert alert-success alert-dismissible">' +
                            '<button type="button" class="close   fa fa-times " data-dismiss="alert" aria-hidden="true"></button>' +
                            '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' +
                            'Successfully updated.' +
                            '</div>');
                } else
                {
                    $("#warning_message").html('<div class="alert alert-danger alert-dismissible">' +
                            '<button type="button" class="close   fa fa-times " data-dismiss="alert" aria-hidden="true"></button>' +
                            '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' +
                            'Some thing went wrong.' +
                            '</div>');
                }
            }
        });

    }
</script>
@endsection
