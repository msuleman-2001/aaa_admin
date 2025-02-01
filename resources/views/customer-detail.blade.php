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
    <!-- Left Panel -->
    @include('partials.leftpanel')
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        @include('partials.header')
        <!-- Header-->
        <div class="content">
            <div class="animated fadeIn">
                <div class="ui-typography">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title" v-if="headerText">Location Detail</strong>
                                </div>
                                <div class="card-body">
                                    <div class="vue-misc">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Customer Name</strong><br>
                                                <span>Alex</span><br><br>
                                                <strong>Email</strong><br>
                                                <span>alex@aaa.com</span><br><br>
                                                <strong>Address</strong><br>
                                                <span>some address</span><br><br>
                                                <strong>Phone</strong><br>
                                                <span>123456</span><br><br>
                                                <strong>Date Join</strong><br>
                                                <span>12/12/2024</span><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                <img src="images/admin.jpg" width="200px" alt="">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


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