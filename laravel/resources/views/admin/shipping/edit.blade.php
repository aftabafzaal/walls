@extends('admin/admin_template')

@section('content')
<div class="row">
    <div class="col-md-10">
      <!-- Horizontal Form -->
      
      <!-- /.box -->
      <!-- general form elements disabled -->
      <div class="box box-warning">
      
        <div class="box-header with-border">
          <h3 class="box-title">Edit Shipping</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
           {!! Form::model($model, ['class' => 'form','url' => ['admin/shipping/update', $model->id], 'method' => 'post']) !!}
            <!-- text input -->
             @include('admin.shipping.form')
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>

@endsection