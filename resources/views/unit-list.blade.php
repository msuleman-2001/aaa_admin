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
            
            let spanStatus = document.getElementById('spanStatus' + activation_switch.dataset.id);
            spanStatus.innerText = 'Wating for update ...';
            const enabled = activation_switch.checked ? 1 : 0; // Get the new state of the switch
            const url = "{{ route('set-unit-activate-status') }}";
            let payload = JSON.stringify
                ({
                    unit_id: activation_switch.dataset.id,
                    enable: enabled,
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
                if (response.ok)
                    spanStatus.innerText = '';
                else
                    spanStatus.innerText = 'Sorry!'
            } catch (error) {
                 alert(error.message);
            }
            
        }
    </script>
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
                                <strong class="card-title">Units</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span>
                                            <strong>Select Location</strong>
                                        </span>
                                        <div class="col-md-6 mb-4">
                                            <select name="ddlLocations" id="ddlLocations" class="form-control">
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->location_number }}">{{ $location->location_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="display: flex; justify-content: flex-end;">
                                            <!-- <button class="btn-success" onclick="updateUnitData();">Update from WSS</button> -->
                                            <span id="spanStatus"></span>
                                        </div>
                                    </div>
                                </div>
                                @if (count($units) === 0)
                                    <h4 class="text-danger">No data found</h4>
                                @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Location Name</th>
                                                <th scope="col">Rent (Per Month)</th>
                                                <th scope="col">Unit Size</th>
                                                <th scope="col">View Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = 1;
                                            @endphp
                                            @foreach ($units as $unit)
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>{{ $unit->location_name }}</td>
                                                    <td>{{ $unit->rent_per_month }}</td>
                                                    <td>{{ $unit->unit_size }}
                                                        <!-- <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" data-id="{{ $unit->unit_id }}" id="chkEnable{{$unit->unit_id}}" name="chkEnable{{$unit->unit_id}}" onchange="updateActivationStatus(this)" {{ $unit->enable ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="chkEnable{{$unit->unit_id}}"><span id="spanStatus{{ $unit->unit_id }}"></span></label>
                                                        </div> -->
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('unit-detail', ['unit_id' => $unit->unit_id]) }}" class="btn-sm btn-danger">View Details</a>
                                                    </td>
                                                    @php
                                                        $counter++;
                                                    @endphp
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
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