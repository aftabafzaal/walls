@extends('admin/admin_template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->

        <!-- /.box -->
        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Result</h3>
            </div>
            <div class="box-body">
                {!! Form::model($model, ['files' => true,'class' => 'form','url' => ['admin/orders/results/update', $model->id], 'method' => 'post']) !!}
                @include('admin.orders_results.form')
                {!! Form::hidden('order_id',$order_id) !!}
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

@endsection