<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.leftpanel')
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        @include('partials.header')
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Admins ({{ $msg ?? 'na' }})</strong>
                            </div>
                            <div class="card-body">
                                <p><a href="{{ route ('new-admin') }}" class="btn btn-success">Add New Admin</a></p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Enable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>mark@aaa.com</td>
                                            <td>1234556</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="switch1">
                                                    <label class="custom-control-label" for="switch1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        <div class="clearfix"></div>
        @include('partials.footer')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    @include('partials.foot')
</body>

</html>