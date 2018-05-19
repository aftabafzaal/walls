@extends('admin/admin_template')

@section('content')

<hr>
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="box-body">
            <div class="col-md-6">
                <h1>Profile</h1>
                <br>
                <table class="table table-striped table-bordered table-hover">

                    <tr class="bg-info">
                        <th>Name</th>
                        <td>{{ $name }}</td>
                    </tr>
                    <tr class="bg-info">
                        <th>Email</th>
                        <td>{{ $email }}</td>
                    </tr>
                    <tr class="bg-info"> 
                        <th>Registration Date</th>
                        <td><?php echo date("d M Y", strtotime($reg_date)); ?></td>
                    </tr>


                </table>
            </div>
        </div>
    </div>
</div>

@endsection
