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
                                    <strong class="card-title">Payment Detail</strong>
                                </div>
                                <div class="card-body">
                                    <div class="vue-misc">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="ml-5 mb-3">
                                                    <span><strong>Customer Name</strong></span><br />
                                                    <span>{{ $payment->customer_name }}</span>
                                                </div>
                                                <div class="ml-5 mb-3">
                                                    <span><strong>Email</strong></span><br />
                                                    <span>{{ $payment->customer_email }}</span>
                                                </div>
                                                <div class="ml-5 mb-3">
                                                    <span><strong>Phone</strong></span><br />
                                                    <span>{{ $payment->customer_phone }}</span>
                                                </div>
                                                <div class="ml-5 mb-3">
                                                    <span><strong>Address</strong></span><br />
                                                    <span>{{ $payment->customer_address }}</span>
                                                </div>
                                                <div class="ml-5 mb-3">
                                                    <span><strong>Insurance ID</strong></span><br />
                                                    <span>{{ $payment->insurance_id }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="ml-5 mb-3">
                                                <span><strong>Unit</strong></span><br />
                                                <span>{{ $payment->unit_key }}</span>
                                            </div>
                                            <div class="ml-5 mb-3">
                                                <span><strong>Move In Date</strong></span><br />
                                                <span>{{ $payment->move_in_date }}</span>
                                            </div>
                                            <div class="ml-5 mb-3">
                                                <span><strong>Ammount Paid</strong></span><br />
                                                <span>{{ $payment->pay_amount }}</span>
                                            </div>
                                            <div class="ml-5 mb-3">
                                                <span><strong>Date Payment</strong></span><br />
                                                <span>{{ $payment->created_at }}</span>
                                            </div>
                                            <div class="ml-5 mb-3">
                                                <span><strong>Remarks</strong></span><br />
                                                <span>{{ $payment->remarks ? $payment->remarks : 'NA' }}</span>
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