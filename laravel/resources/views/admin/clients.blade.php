@extends('admin/admin_template')

@section('content')

<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Users</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>

                </div>
            </div>
            <div class="box-body">

                <ul class="products-list product-list-in-box">

                    <table class="table" id="order_table">
                        <thead>
                            <tr >
                                <th>#</th>
                                <th>Name</th>
                                <th>Joined As</th>
                                <th>Email</th>
                                <th>Registration Date</th>
                                <td></td> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($model as $row)
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row->firstName . ' ' . $row->lastName; ?></td>
                                <td><?php echo ucfirst($row->role); ?></td>
                                <td><?php echo $row->email; ?></td>
                                <td><?php echo date("d M Y", strtotime($row->created_at)); ?></td>
                                <td><a href="user/{{$row->id}}">Detail</a></td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach

                        </tbody>

                    </table>
                </ul>
                <div class="col-md-12">
                    <?php echo $model->appends([])->render(); ?>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

<script>

    function delete_category(value) {
        var r = confirm("Sure to Delete this Category ?");
        if (r == true) {
            window.location = 'delete_category/' + value;
        } else
        {
        }
    }

</script>