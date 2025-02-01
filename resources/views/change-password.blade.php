<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    @include('partials.head')
    <style>
    #divFormContainer {
        width: 100%;
        height: 520px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-settings {
        width: 50%;
    }
    </style>
</head>

<body>
    @include('partials.leftpanel')
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        @include('partials.header')
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!--  Traffic  -->
                <div class="row">
                    <div id="divFormContainer">
                        <div class="card card-settings">
                            <form action="{{ route('change-password') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="card-header">
                                    <strong>Change Password</strong>
                                </div>
                                @csrf
                                <div class="card-body card-block">
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="txtCurrentPassword" class=" form-control-label">Current Password</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="password" id="txtCurrentPassword" name="txtCurrentPassword" placeholder="Enter Current Password..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="txtNewPassword" class=" form-control-label">New Password</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="password" id="txtNewPassword" name="txtNewPassword" placeholder="Enter New Password..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="txtConfirmPassword" class=" form-control-label">Confirm Password</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="password" id="txtConfirmPassword" name="txtConfirmPassword" placeholder="Enter Confirm Password..." class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        @include('partials.footer')
    </div>
    <!-- /#right-panel -->
    @include('partials.foot')
</body>

</html>