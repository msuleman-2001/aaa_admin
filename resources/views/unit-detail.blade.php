<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    @include('partials.head')
    <script>
        async function updateUnit(){
            let txtRent = document.getElementById('txtRentPerMonth');
            let txtFeatures = document.getElementById('txtFeatures');
            let txtCoupons = document.getElementById('txtCoupons');
            let txtSelectedCouponIndex = document.getElementById('txtSelectedCouponIndex');
            
            let span_status = document.getElementById('spanStatus');
            let new_rent = txtRentPerMonth.value;
            let features = txtFeatures.value;
            let coupons = txtCoupons.value;
            let selected_coupon_index = txtSelectedCouponIndex.value;
            const current_url = window.location.pathname; 
            
            const unit_id = current_url.split('/').pop();
            const url = "{{ route('update-unit') }}";
            span_status.innerText = 'Updating data ...';

            let payload = JSON.stringify({unit_id: unit_id, rent_per_month: new_rent, features: features, coupons: coupons, selected_coupon_index: selected_coupon_index });
            alert(payload);
            //return;
            try {
                let response = await fetch(url, {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}" // Include CSRF token for security
                    },
                    body: payload
                });
                const data = await response.json();

                if (response.ok)
                    span_status.innerText = data.message;
                else
                    spans_tatus.innerText = 'Sorry!'
            } catch (error) {
                  alert(error.message);
            }
        }
    </script>
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
                                    <strong class="card-title">Unit Detail</strong>
                                </div>
                                <div class="card-body">
                                    <div class="vue-misc">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row mt-3 mb-3">
                                                    <div class="col">
                                                        <strong>Unit Size</strong>
                                                    </div>
                                                    <div class="col">{{ $unit->unit_size }}</div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    <div class="col">
                                                        <strong>Enter Coupon (Coupon Name, Amount)</strong>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    <div class="col">
                                                        @php
                                                            $coupons_array = json_decode($unit->coupons_data, true);
                                                            $coupons_data = "";
                                                            $selected_index = "";
                                                            $index = 1;
                                                            if (!empty($coupons_array)){
                                                                foreach ($coupons_array as $coupon){
                                                                    $coupons_data .= $coupon['couponName'] . ", " . $coupon['couponValue'] . "\n";
                                                                    if ($coupon['selected'] == 1)
                                                                        $selected_index = $index;
                                                                    $index++;
                                                                }
                                                            }
                                                        @endphp
                                                        <textarea name="txtCoupons" id="txtCoupons" rows="4" class="form-control">{{ $coupons_data }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    <div class="col">
                                                        <strong>Selected Coupon (row number)</strong>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" id="txtSelectedCouponIndex" name="txtSelectedCouponIndex" class="form-control" value="{{ $selected_index }}">
                                                    </div>
                                                </div>
                                                <!-- <p><strong>Insurance Options:</strong><br />
                                                @php
                                                    $insurance_options = json_decode($unit->insurance_options, true);
                                                @endphp
                                                @if (!empty($insurance_options) && is_array($insurance_options))
                                                    <ul class="ml-5">
                                                        @foreach ($insurance_options as $insurance)
                                                            <li>{{ $insurance['description'] }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p>No insurance options available.</p>
                                                @endif -->
                                                <div class="row mt-3 mb-3"">
                                                    <div class="col">
                                                        <strong>New Rent</strong>
                                                    </div>
                                                    <div class="col">
                                                        <input class="form-control" type="text" id="txtRentPerMonth" name="txtRentPerMonth" value="{{ $unit->rent_per_month }}" data-unit-id="{{ $unit->unit_id }}">
                                                    </div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    <div class="col">
                                                    <span id="spanStatus"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row mt-3 mb-3">
                                                    <div class="col">
                                                        <strong>Features</strong>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    <div class="col">
                                                        @php
                                                            $features = $unit->unit_features;
                                                        @endphp
                                                        <textarea class="form-control" name="txtFeatures" id="txtFeatures" rows="10">{{ implode("\n", json_decode($features, true)) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-3">
                                            <div class="col">
                                                <button onclick="updateUnit()" class="btn btn-success">Save</button>
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