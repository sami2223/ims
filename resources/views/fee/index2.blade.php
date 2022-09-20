@extends('layouts.admin')
@section('pageTitle')
    Fee Management
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="d-flex justify-content-between">
                <h4>Fee Details</h4>
                <form id="regForm2" action="{{ route('fees.feeSearchBySlipNo') }}" method="post" class="form-horizontal">
                    @csrf

                    <div class="input-group">

                        <input type="text" name="slip_no" id="slip_no" placeholder="Slip No..." class="form-control"
                            data-error="#sh">

                        <span class="input-group-append">
                            <button type="submit" class="btn btn-success">Search</button>

                        </span>
                    </div>
                    <span id="sh"></span>

                    <span id="errorA1" class="ml-4"></span>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Students List</h3>
                    <div class="float-right">

                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="form-group col-md-3">
                            <div id="courseD" class="row">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">Course<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select name="selectCourse" id="selectCourse" class="form-control select2"
                                        data-error="#errorA1">
                                        <option value="">Please select</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    <span id="errorA1"></span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-md-3">
                            <div id="sessionD" class="row">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">Session<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select name="selectSession" id="session" class="form-control select2"
                                        data-error="#errorA3">
                                        <option value="0">Please select</option>
                                        {{-- @foreach ($sessions as $session)
                                    <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                                @endforeach --}}
                                    </select>
                                    <span id="errorA3"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div id="shiftD" class="row">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">Shift<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select name="selectShift" id="shift" class="form-control select2"
                                        data-error="#errorA2">
                                        <option value="">Please select</option>
                                        @foreach ($shifts as $shift)
                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="errorA2"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row stdTable">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="" class="col-md-12">

                        <div id="tbl" class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Student Name</th>
                                        <th>Father Name</th>
                                        <th>Reg No.</th>
                                        <th>Student Contact</th>
                                        <th>Father Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbd" class="text-center">

                                </tbody>
                            </table>
                        </div>

                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // form validation
        $('#regForm2').validate({
            rules: {
                slip_no: {
                    required: true,
                },
            },
            messages: {
                slip_no: {
                    required: "Please enter a Slip No.",
                },
            },
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $("#shift").prop("disabled", true);
        $("#session").prop("disabled", true);
        $("#batch").prop("disabled", true);


        $(document).ready(function() {

            var table = $("#example").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            //  change course
            $('#selectCourse').change(function() {
                //$().removeClass("d-none")
                // $('.stdTable').hide();

                $("#session").prop("disabled", false);
                $('#selectCourse').change(function() {
                    $('#shift').prop('selectedIndex', 0);
                    $('#shift').trigger('change');
                });
                // Course id
                var id = $(this).val();
                // Empty the dropdown
                $('#session').find('option').not(':first').remove();
                // empty the table
                $('#tbd').find('tr').remove();
                // AJAX request 
                $.ajax({
                    url: '/getSessions/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].course;

                                var option = '<option value="' + id + '">' + name + '</option>';

                                $("#session").append(option);
                            }
                        }

                    }
                });
            });

            //  change session
            $('#session').change(function() {
                table.destroy();
                $("#shift").prop("disabled", false);

                // session id
                var session_id = $(this).val();
                var shft_id = $('#shift').val();
                // console.log(shft_id);

                // Empty the table body
                $('#tbd').find('tr').remove();

                // AJAX request 
                $.ajax({
                    url: '/getStudentsViaSessionShift/' + session_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }
                        var sno = 1;
                        if (len > 0) {
                            if (shft_id >= 1) {
                                // Read data and create <option >
                                for (var i = 0; i < len; i++) {
                                    if (shft_id == response['data'][i].shift_id) {
                                        var id = response['data'][i].id;
                                        var fname = response['data'][i].first_name;
                                        var lname = response['data'][i].last_name;
                                        if (lname == null)
                                            lname = " ";

                                        var row = `
                                <tr>
                                    <td>` + sno++ + `</td>
                                    
                                    <td>` + fname + ' ' + lname + `</td>
                                    <td>` + response['data'][i].father_name + `</td>
                                    <td>` + response['data'][i].reg_no + `</td>
                                    <td>` + response['data'][i].mobile + `</td>
                                    <td>` + response['data'][i].father_contact + `</td>
                                    <td>
                                        <a href="/fees/` + id + `" class="btn btn-info btn-block">
                                            Fee Details
                                        </a>
                                    </td>
                                </tr>`;

                                        $("#tbd").append(row);
                                    }
                                }
                            } else {
                                // Read data and create <option >
                                for (var i = 0; i < len; i++) {

                                    var id = response['data'][i].id;
                                    var fname = response['data'][i].first_name;
                                    var lname = response['data'][i].last_name;
                                    if (lname == null)
                                        lname = " ";

                                    var row = `
                                <tr>
                                    <td>` + sno++ + `</td>
                                    
                                    <td>` + fname + ' ' + lname + `</td>
                                    <td>` + response['data'][i].father_name + `</td>
                                    <td>` + response['data'][i].reg_no + `</td>
                                    <td>` + response['data'][i].mobile + `</td>
                                    <td>` + response['data'][i].father_contact + `</td>
                                    <td>
                                        <a href="/fees/` + id + `" class="btn btn-info btn-block">
                                            Fee Details
                                        </a>
                                    </td>
                                </tr>`;

                                    $("#tbd").append(row);

                                }
                            }

                        }

                        table = $("#example").DataTable({
                            "responsive": true,
                            "autoWidth": false,
                        });

                    }
                });
            });

            //  change shift
            $('#shift').change(function() {

                table.destroy();
                // session id
                var session_id = $('#session').val();
                console.log(session_id);
                if (session_id > 0) {
                    var shft_id = $(this).val();


                    // Empty the table body
                    $('#tbd').find('tr').remove();

                    // AJAX request 
                    $.ajax({
                        url: '/getStudentsViaSessionShift/' + session_id,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response);
                            var len = 0;
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }
                            var sno = 1;
                            if (len > 0) {
                                // Read data and create <option >
                                for (var i = 0; i < len; i++) {
                                    if (shft_id == response['data'][i].shift_id) {
                                        var id = response['data'][i].id;
                                        var fname = response['data'][i].first_name;
                                        var lname = response['data'][i].last_name;
                                        if (lname == null)
                                            lname = " ";

                                        var row = `<tr>
                                        <td>` + sno++ + `</td>
                                        
                                        <td>` + fname + ' ' + lname + `</td>
                                        <td>` + response['data'][i].father_name + `</td>
                                        <td>` + response['data'][i].reg_no + `</td>
                                        <td>` + response['data'][i].mobile + `</td>
                                        <td>` + response['data'][i].father_contact + `</td>
                                        <td>
                                            <a href="students/` + id + `" class="btn btn-info btn-block">
                                                View Details
                                            </a>
                                        </td>
                                        </tr>`;

                                        $("#tbd").append(row);
                                    }

                                }
                            }

                            table = $("#example").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                            });

                        }
                    });
                }

            });
        });
    </script>


@endsection
