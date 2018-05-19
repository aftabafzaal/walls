@extends('admin/admin_template')

@section('content')
<div class="row">
    <div class="col-md-10">
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
          <h3 class="box-title">Add New Value</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {!! Form::open(array( 'class' => 'form','url' => 'admin/attributes_values/insert', 'files' => true)) !!}
            <!-- text input -->
            @include('admin.attributes_values.form')
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
            </div>
            
          {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
@endsection