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
                            <form action="{{ route('edit-profile') }}" method="post" class="form-horizontal"
                                enctype="multipart/form-data">
                                <div class="card-header">
                                    <strong>Edit Profile</strong>
                                </div>
                                <div class="card-body card-block">

                                    @csrf
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="txtName" class=" form-control-label">Display Name</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="txtName" name="txtName"
                                                value="{{ old('txtName', $user->name) }}" placeholder="Enter Name..."
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="txtPhone" class="form-control-label">Phone</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="txtPhone" name="txtPhone"
                                                value="{{ old('txtName', $user->phone) }}" placeholder="Enter Phone..."
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="fulImage" class=" form-control-label">Picture</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="fulImage" name="fulImage"
                                                placeholder="Select Picture..." class="form-control">
                                        </div>
                                        <div class="col col-md-3">
                                            <label for="fulImage" class=" form-control-label"></label>
                                        </div>
                                        <div class="col-12 col-md-9 mt-3">
                                            <img width="100" src="{{ $user->profile_photo_path }}" alt="">
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