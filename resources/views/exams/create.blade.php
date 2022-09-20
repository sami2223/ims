@extends('layouts.admin')

@section('pageTitle')
    Exams Management
@endsection

@section('content')


    {{-- Form --}}
    <div class="row">

        <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="regForm" action="/exams" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <strong>Exam Registration</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div  class="form-group col-md-3">
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
                                <div id="examD" class="row">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Exam<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="exam_type" id="exam" class="form-control select2"
                                            data-error="#errorAY">
                                            <option value="">Please select</option>
                                            @foreach ($examTypes as $examType)
                                                <option value="{{ $examType->id }}">{{ $examType->type }}</option>
                                            @endforeach
                                        </select>
                                        <span id="errorAY"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center col-md-12">
                            {{-- <div class="row form-group col-md-4">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">Description</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="text" id="description" name="description" placeholder=""
                                        class="form-control">
                                </div>
                            </div> --}}

                            {{-- <div class="row form-group col-md-8">
                                <div class="col col-md-2">
                                    <label for="text-input" class=" form-control-label">Exam Date</span></label>
                                </div>
                                <div class="col-12 col-md-2 mb-1">
                                    <select name="selectDay" id="selectDay" class="form-control select2">
                                        <option value="">Day</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            @if ($i < 10) 
                                            <?php $i = '0' . $i; ?> 
                                            @endif 
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 mb-1">
                                    <select name="selectMonth" id="selectMonth" class="form-control select2">
                                        <option value="">Month</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            @if ($i < 10) 
                                            <?php $i = '0' . $i; ?> 
                                            @endif 
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectYear" id="selectYear" class="form-control select2">
                                        <option value="">Year</option>
                                        @for ($i = 2021; $i <= 2099; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div> --}}
                        </div>

                        <div id="" class="stdTable col-md-12">

                            <div id="tbl" class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th><input type="checkbox" id="checkAll" checked></th>
                                            <th>S.No.</th>
                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>Reg No.</th>
                                            <th>Student Contact</th>
                                            <th>Father Contact</th>

                                        </tr>
                                    </thead>
                                    <tbody id="tbd" class="text-center">
                                        
                                    </tbody>
                                </table>
                            </div>

                            <!-- END DATA TABLE -->
                        </div>


                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-md-2">
                            <button type="submit" class="stdTable btn btn-success btn-block">
                             Register
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        $("#shift").prop("disabled", true);
        $("#session").prop("disabled", true);
        $("#exam").prop("disabled", true);
        // $('#shiftD').hide();
        // $('#sessionD').hide();
        // $('#examD').hide();
        $('.stdTable').hide();
        $(document).ready(function() {
            
            // form validation
            $("#regForm").validate({
                rules: {
                    exam_type: {
                        required: true,
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

            $('#selectCourse').change(function() {
                //$().removeClass("d-none")
                $('.stdTable').hide();
                // $('#shiftD').show();
                $("#shift").prop("disabled", false);
                // Course id
                var id = $(this).val();
                // Empty the dropdown
                $('#session').find('option').not(':first').remove();
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
                // $('#examD').show();
                $("#exam").prop("disabled", false);
                // session id
                var session_id = $(this).val();
                var shft_id = $('#shift').val();
                console.log(shft_id);

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
                                                <td class="checkboxes"><input type="checkbox" class="std_id"
                                                        name="studentid[]" value="` + id + `" checked></td>
                                                <td>` + sno++ + `</td>
                                                
                                                <td>` + fname + ' ' + lname + `</td>
                                                <td>` + response['data'][i].father_name + `</td>
                                                <td>` + id + `</td>
                                                <td>` + response['data'][i].mobile + `</td>
                                                <td>` + response['data'][i].father_contact + `</td>
                                            </tr>`;

                                    $("#tbd").append(row);
                                }

                            }
                        }
                    }
                });
            });

            //  change shift
            $('#shift').change(function() {
                // $('#sessionD').show();
                $("#session").prop("disabled", false);
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
                                <td class="checkboxes"><input type="checkbox" class="std_id"
                                        name="studentid[]" value="` + id + `" checked></td>
                                <td>` + sno++ + `</td>
                                
                                <td>` + fname + ' ' + lname + `</td>
                                <td>` + response['data'][i].father_name + `</td>
                                <td>` + id + `</td>
                                <td>` + response['data'][i].mobile + `</td>
                                <td>` + response['data'][i].father_contact + `</td>
                            </tr>`;

                                        $("#tbd").append(row);
                                    }

                                }
                            }
                        }
                    });
                }

            });

            $('#exam').change(function(){
                $('.stdTable').show();
            });
            // check all
            $(document).ready(function() {
                $('#checkAll').click(function() {
                    var checked = $(this).prop('checked');
                    $('.checkboxes').find('input:checkbox').prop('checked', checked);
                });
            });
        });
    </script>

@endsection
