<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="side-bar open">
    <ul class="side-nav list scrollbar bg-hunterBlue" id="style-3">
        <li class="active">
            <a href="{{ url('/dashboard') }}"><span><i class="fa fa-dashboard"></i></span>Dashboard</a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#widget">
                <span><i class="fa fa-cogs"></i></span> Setting
                <span><i class="fa fa-fw fa-caret-down pull-right"></i></span>
            </a>
                <ul id="widget" class="sub-menu sub-menu1 collapse">
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#location"><span><i class="fa fa-map-marker"></i></span> Location <span><i class="fa fa-fw fa-caret-down pull-right"></i></span></a>
                        <ul id="location" class="collapse sub-menu">
                            <li><a href="{{ url('/location') }}">Locations</a></li>
                            <li><a href="{{ url('/location/create') }}">Create New location</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users"><span><i class="fa fa-users"></i></span> User <span><i class="fa fa-fw fa-caret-down pull-right"></i></span></a>
                        <ul id="users" class="collapse sub-menu">
                            <li><a href="{{ url('/user') }}">Users</a></li>
                            <li><a href="{{ url('/user/create') }}">Add User</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Category"><span><i class="fa fa-tags"></i></span> Category<span><i class="fa fa-fw fa-caret-down pull-right"></i></span></a>
                        <ul id="Category" class="collapse sub-menu">
                            <li><a href="{{ url('/category') }}">Categories</a></li>
                            <li><a href="{{ url('/category/create') }}">Add Category</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#product"><span><i class="fa fa-cube"></i></span> Product<span><i class="fa fa-fw fa-caret-down pull-right"></i></span></a>
                        <ul id="product" class="collapse sub-menu">
                            <li><a href="{{ url('/product') }}">Products</a></li>
                            <li><a href="{{ url('/product/create') }}">Add product</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#vendor"><span><i class="fa fa-industry"></i></span> Vendor <span><i class="fa fa-fw fa-caret-down pull-right"></i></span></a>
                        <ul id="vendor" class="collapse sub-menu">
                            <li><a href="{{ url('/seller') }}">Vendors</a></li>
                            <li><a href="{{ url('/seller/create') }}">Add Vendor</a></li>
                        </ul>
                    </li>
                
                </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#order"><span><i class="fa fa-shopping-bag"></i></span> Order <span><i class="fa fa-fw fa-caret-down pull-right"></i></span></a>
            <ul id="order" class="collapse sub-menu">
                <li><a href="{{ url('/order') }}">Orders</a></li>
                <li><a href="{{ url('/order/create') }}">Create New order</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#report"><span><i class="fa fa-book"></i></span> Problem Report <span><i class="fa fa-fw fa-caret-down pull-right"></i></span></a>
            <ul id="report" class="collapse sub-menu">
                <li><a href="{{ url('/report') }}">Reports</a></li>
                <li><a href="{{ url('/report/create') }}">Create New report</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#service"><span><i class="fa fa-envelope"></i></span> CSR <span><i class="fa fa-fw fa-caret-down pull-right"></i></span></a>
            <ul id="service" class="collapse sub-menu">
                <li><a href="{{ url('/service') }}">CSRs</a></li>
                <li><a href="{{ url('/service/create') }}">Create New CSR</a></li>
            </ul>
        </li>
        
        <!-- <li class="">
            <a href="form1.php"><span><i class="fa fa-envelope"></i></span>Customer Problem Report</a>
        </li> -->
    </ul>
</div>

