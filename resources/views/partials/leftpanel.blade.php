<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title"><a href="{{ route ('location-detail') }}">Location</a></li><!-- /.menu-title -->
                <li class="menu-title"><a href="{{ route ('unit-list') }}">Units</a></li>
                <li class="menu-title"><a href="{{ route ('customer-list') }}">Customers</a></li>
                <li class="menu-title"><a href="{{ route ('payment-list') }}">Payments</a></li>
                <li class="menu-title"><a href="{{ route ('review-list') }}">Reviews</a></li>
                <li class="menu-title"><a href="{{ route ('admin-list') }}">Admin Settings</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->