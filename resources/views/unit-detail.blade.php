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
            
            let span_status = document.getElementById('spanStatus');
            let new_rent = txtRentPerMonth.value;
            let features = txtFeatures.value;
            const current_url = window.location.pathname; 
            
            const unit_id = current_url.split('/').pop();
            const url = "{{ route('update-unit') }}";
            span_status.innerText = 'Updating data ...';
            
            let payload = JSON.stringify({unit_id: unit_id, rent_per_month: new_rent, features: features });
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
                                                <p><strong>Size:</strong>
                                                <span>{{ $unit->location_number }}</span></p>
                                                <p><strong>Insurance Options:</strong><br />
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
                                                @endif
                                                <p><strong>New Rate</strong><br>
                                                <input class="form-control" type="text" id="txtRentPerMonth" name="txtRentPerMonth" value="{{ $unit->rent_per_month }}" data-unit-id="{{ $unit->unit_id }}"><br />
                                                <button onclick="updateUnit()" class="btn-sm btn-success">Update</button><br>
                                                <span id="spanStatus"></span></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Features</strong></p>
                                                @php
                                                    $features = json_decode($unit->unit_features, true);
                                                @endphp
                                                <p>
                                                    <textarea class="form-control" name="txtFeatures" id="txtFeatures" rows="11">{{ implode("\n", $features) }}</textarea>
                                                </p>
                                                <p><button onclick="updateUnit()" class="btn-sm btn-success">Update</button></p>
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