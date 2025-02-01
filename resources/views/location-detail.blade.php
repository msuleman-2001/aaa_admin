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
        async function updateActivationStatus(activation_switch){
            let spanStatus = document.getElementById('spanStatus');
            spanStatus.innerText = 'Wating for update ...';
            const locationId = activation_switch.dataset.id; // Get location ID from data attribute
            const enabled = activation_switch.checked ? 1 : 0; // Get the new state of the switch
            const url = "{{ route('set-activate-status') }}";
            let payload = JSON.stringify
                ({
                    id: locationId,
                    enable: enabled
                });
            
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
                if (response.ok) {
                    spanStatus.innerText = enabled ? 'Activated' : 'Deactivated';
                } else {
                    throw new Error(data.message || "An error occurred.");
                }
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
                                    <strong class="card-title" v-if="headerText">Location</strong>
                                </div>
                                <div class="card-body">
                                    <div class="vue-misc">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" id="chkEnable" name="chkEnable" class="custom-control-input" data-id="{{ $location_data->location_id }}" onchange="updateActivationStatus(this)" {{ $location_data->enable ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="chkEnable"><span id="spanStatus">{{$location_data->enable ? 'Activated' : 'Deactivated' }}</span></label>
                                                </div><br>
                                                <strong>Location Number:</strong><br>
                                                <span>{{ $location_data->location_number }}</span><br><br>
                                                <strong>Location Name</strong><br>
                                                <span>{{ $location_data->name }}</span><br><br>
                                                <strong>Address</strong><br>
                                                <span>{{ $location_data->address }}</span><br><br>
                                                <strong>Phone</strong><br>
                                                <span>{{ $location_data->phone}}</span><br><br>
                                                <div>
                                                    <strong>Features</strong><br>
                                                    <ul class="ml-4">
                                                        @foreach ($location_data->features as $feature)
                                                            <li>{{ $feature['description'] }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Map</strong>
                                                <div class="jumbotron" style="height: 40vh;">
                                                {{ $location_data->latitude}}, {{ $location_data->longitude}}
                                                </div>
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