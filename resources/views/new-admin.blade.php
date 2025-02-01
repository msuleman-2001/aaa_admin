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
        #divFormContainer{
            width: 100%; 
            height: 520px; 
            display: flex; 
            justify-content: center; 
            align-items: center;
        }

        .card-settings{
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
                            <div class="card-header">
                                <strong>New Admin</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="#" method="post" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="hf-email"
                                                class=" form-control-label">Full Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="hf-email" name="hf-email"
                                                placeholder="Enter Full Name..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="hf-email"
                                                class=" form-control-label">Display Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="hf-email" name="hf-email"
                                                placeholder="Enter Display Name..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="hf-email"
                                                class=" form-control-label">Email</label></div>
                                        <div class="col-12 col-md-9"><input type="email" id="hf-email" name="hf-email"
                                                placeholder="Enter Email..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="hf-password" class=" form-control-label">Password</label>
                                        </div>
                                        <div class="col col-md-9">
                                            <span>admin124#</span>
                                            <button class="btn btn-secondary btn-sm">Regenerate</button>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="hf-email"
                                                class=" form-control-label">Display Image</label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="hf-email" name="hf-email"
                                                placeholder="Enter Email..." class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                            </div>
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