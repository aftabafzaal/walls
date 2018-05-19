@extends('admin/admin_template')

@section('content')
<style>
    .loader,
    .loader:before,
    .loader:after {
        border-radius: 50%;
    }
    .loader:before,
    .loader:after {
        position: absolute;
        content: '';
    }
    .loader:before {
        width: 5.2em;
        height: 10.2em;
        background: #ffffff;
        border-radius: 10.2em 0 0 10.2em;
        top: -0.1em;
        left: -0.1em;
        -webkit-transform-origin: 5.2em 5.1em;
        transform-origin: 5.2em 5.1em;
        -webkit-animation: load2 2s infinite ease 1.5s;
        animation: load2 2s infinite ease 1.5s;
    }
    .loader {
        font-size: 11px;
        text-indent: -99999em;
        margin: 55px auto;
        position: relative;
        width: 10em;
        height: 10em;
        box-shadow: inset 0 0 0 1em #3C8DBC;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }
    .loader:after {
        width: 5.2em;
        height: 10.2em;
        background: #ffffff;
        border-radius: 0 10.2em 10.2em 0;
        top: -0.1em;
        left: 5.1em;
        -webkit-transform-origin: 0px 5.1em;
        transform-origin: 0px 5.1em;
        -webkit-animation: load2 2s infinite ease;
        animation: load2 2s infinite ease;
    }
    @-webkit-keyframes load2 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @keyframes load2 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
</style>

<?php
$currency = Config::get('params.currency');
$orderPrefix = Config::get('params.order_prefix');
?>
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- PRODUCT LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">( Total : {{ count($orders) }} ) </h3>
                <div class="form-group" style="margin: -26px 0px 0px 263px;position: absolute;width: 173px;">
                    <label for="type" style="position: absolute;margin: 6px 0px 0px -95px;">Order Status</label>
                    <select class="form-control"  id="order_status" name="type">
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="complete">Complete</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="closed">Closed</option>
                        <option value="onhold">On Hold</option>
                    </select>
                </div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
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
                                <td><a href="order/{{$order->id}}">Detail</a></td>                                    
                            </tr>
                            @endforeach 
                        </tbody>

                    </table>
                    <div id="warning_message" ></div>
                    <div class="loader" style="display: none;">Loading...</div>
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
<!-- This file is already exist in header but it is not loaded properly -->
<!-- jQuery 2.1.4 -->
<script src="{{ asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script>

$("#order_status").change(function () {
    $("#warning_message").html('');
    $('#order_table tbody tr').remove();
    $('.loader').css('display', 'block');
    var CSRF_TOKEN = "{{ csrf_token() }}";
    var STATUS = $('#order_status').val();
    $('#error_message').css('display', 'none');
    $.ajax({
        url: '{{ url("admin/orderStatus") }}',
        type: 'POST',
        data: {_token: CSRF_TOKEN, status: STATUS},
        dataType: 'JSON',
        success: function (data) {
            var obj = (data);
            $('.loader').css('display', 'none');
            if (!$.isEmptyObject(obj))
            {


                var newRowContent = '';
                $.each(obj, function (key, value) {

                    newRowContent += '<tr>' +
                            '<td><?php echo $orderPrefix; ?>' + value.id + '</td>' +
                            '<td>' + value.firstName + ' ' + value.lastName + '</td>' +
                            '<td>' + value.created_at + '</td>' +
                            '<td>' + value.orderStatus + '</td>' +
                            '<td>' + '{{ $currency[Config::get('params.currency_default')]['symbol']}}' + value.grandTotal + '</td>' +
                            '<td><a href="order/' + value.id + '">Detail</a>' +
                            '</td>' +
                            '</tr>';
                });

                $("#order_table tbody").html(newRowContent);

            } else if ($.isEmptyObject(obj))
            {
                $("#warning_message").html('<div class="alert alert-warning alert-dismissible">' +
                        '<button type="button" class="close  fa fa-times" data-dismiss="alert" aria-hidden="true"></button>' +
                        '<h4><i class="icon fa fa-warning"></i> Alert!</h4>' +
                        'Data not found.' +
                        '</div>');
                return false;
            } else if (obj == 0)
            {
                $("#warning_message").html('<div class="alert alert-danger alert-dismissible">' +
                        '<button type="button" class="close   fa fa-times " data-dismiss="alert" aria-hidden="true"></button>' +
                        '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' +
                        'Some thing went wrong.' +
                        '</div>');
            }
        }
    });

});
function GetFormatDate(date_created) {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];
    var tdate = new Date(date_created);
    var dd = tdate.getDate(); //yields day
    var MM = tdate.getMonth(); //yields month
    var yyyy = tdate.getFullYear(); //yields year
    var xxx = dd + "-" + (monthNames[MM]) + "-" + yyyy;

    return xxx;
}
</script>
@endsection

