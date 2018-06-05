<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/front/images/logo.png')}}" class="img-circle" alt="Logo Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Store</li>


            <!-- Optionally, you can add icons to the links -->
            <!-- Admin Links Start-->
            <?php if (Auth::user()->role->role == 'admin') { ?>

                <li class="treeview">
                    <a href="{javascript:void(0);">
                        <i class="fa fa-dashboard"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li class="active"><a href="{{ url('admin/users') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
                       
                    </ul>
                </li>

            <?php } ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ url('admin/products?type=simple') }}"><i class="fa fa-circle-o"></i>Products</a></li>
                    <li><a href="{{ url('admin/products?type=bundle') }}"><i class="fa fa-circle-o"></i> Bundle Products</a></li>

                    <li><a href="{{ url('admin/products/create?type=simple') }}"><i class="fa fa-circle-o"></i> Add New Product</a></li>
                    <li><a href="{{ url('admin/products/create?type=bundle') }}"><i class="fa fa-circle-o"></i> Add Bundle Product</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Cities</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ url('admin/cities') }}"><i class="fa fa-circle-o"></i>List Cities</a></li>
                    <li><a href="{{ url('admin/cities/create') }}"><i class="fa fa-circle-o"></i> Add New City</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Areas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ url('admin/areas') }}"><i class="fa fa-circle-o"></i>List Areas</a></li>
                    <li><a href="{{ url('admin/areas/create') }}"><i class="fa fa-circle-o"></i> Add New Area</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Content Blocks</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ url('admin/content?type=page') }}"><i class="fa fa-circle-o"></i> Pages</a></li>
                    <li><a href="{{ url('admin/content?type=email') }}"><i class="fa fa-circle-o"></i> Emails</a></li>
                    <li><a href="{{ url('admin/content?type=block') }}"><i class="fa fa-circle-o"></i> Blocks</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Orders</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ url('admin/orders') }}"><i class="fa fa-circle-o"></i> All Orders</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>