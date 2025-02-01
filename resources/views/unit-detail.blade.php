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
        async function updateRent(box_name){
            let txtRent = document.getElementById(box_name);
            
            let span_status = document.getElementById('spanStatus');
            let new_rent = txtRent.value;
            const current_url = window.location.pathname; 
            
            const unit_id = current_url.split('/').pop();
            const url = "{{ route('update-rent') }}";
            span_status.innerText = 'Updating rent ...';
            
            let payload = JSON.stringify({unit_id: unit_id, rent_per_month: new_rent });
            
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
                                                <strong>Size</strong><br>
                                                <span>{{ $unit->location_number }}</span><br><br>
                                                <strong>Cubic Footage</strong><br>
                                                <span>1377</span><br><br>
                                                <strong>Square Footage</strong><br>
                                                <span>162</span><br><br>
                                                <strong>Size Description</strong><br>
                                                <span>Drive Up 1st Floor Outside Level No Climate Drivethrough Rollup</span><br><br>
                                                <strong>Rate</strong><br>
                                                <input type="text" id="txtRate" name="txtRate" data-unit-id="{{ $unit->unit_id }}">
                                                <button onclick="updateRent('txtRate')" class="btn-sm btn-success">Update</button><br>
                                                <span id="spanStatus"></span>
                                            </div>
                                            <div class="col-md-6">
                                                
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