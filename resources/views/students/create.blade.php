@extends('layouts.admin')

@section('pageTitle')
    New Admission
@endsection

@php
$batches = App\Models\Batch::all();
@endphp

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="d-flex align-items-center justify-content-between p-t-30 p-b-30"
            style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="float-left">
                <h4>Admission - New Student</h4>
            </div>

            <div class="float-right">
                <a class="btn btn-success mx-1" href="/students">Students List</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}}


    <div class="block text-center mb-4">
        <h2>NEW ADMISSION</h2>
    </div>

    <div class="d-flex justify-content-center">

        <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="regForm" action="/students" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf

                <div class="card">

                    {{-- Upload student's photo --}}
                    <div class="card-header">
                        <strong>Student Image</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="d-flex justify-content-between form-group">
                            <div class="col-md-4">
                                <label for="text-input" class=" form-control-label">Choose File</label>
                                <input type="file" id="chooseFile" name="photo" class="form-control-file"
                                    data-error="#errorPhoto">
                                <span class="text danger" id="errorPhoto"></span>
                                <div class="d-flex col-md-4 justify-content-center">
                                    <div id="my_camera" class=""></div>
                                    <br />
                                </div>
                            </div>

                            <div class="d-flex col-md-4 justify-content-end">
                                <div id="results" class="profile_picture_display2">
                                    <img id="showImage" class="profile_img2" src="{{ asset('images/no_image.jpg') }}">
                                </div>
                            </div>

                        </div>
                        <div class="row form-group justify-content-center">
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">
                            <input type="hidden" name="image" class="image-tag">
                        </div>
                    </div>

                    {{-- Personal Details --}}
                    <div class="card-header">
                        <strong>Student - Personal Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">
                                    First Name<span class="text-danger">*</span>
                                </label>
                                <input type="text" id="fname" name="fname" placeholder="" class="form-control"
                                    data-error="#errorName" maxlength="20">
                                {{-- @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text danger" id="errorName"></span>
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Last Name</label>
                                <input type="text" id="lname" name="lname" placeholder="" class="form-control"
                                    maxlength="20">

                            </div>

                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Father Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="father_name" name="father_name" placeholder=""
                                    class="form-control" data-error="#errorfName" maxlength="50">

                                <span class="text danger" id="errorfName"></span>
                            </div>

                        </div>

                        <div class="row form-group">

                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Date of birth<span
                                        class="text-danger">*</span></label>
                                <div class="row">
                                    <div class=" col-md-4 mb-1">
                                        <select name="selectDay" id="selectDay" class="form-control select2"
                                            data-error="#errorDay">
                                            <option value="">Day</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10)
                                                    <?php $i = '0' . $i; ?>
                                                @endif
                                                <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="text danger" id="errorDay"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMonth" id="selectMonth" class="form-control select2"
                                            data-error="#errorMonth">
                                            <option value="">Month</option>
                                            <option value="01">Jan(01)</option>
                                            <option value="02">Feb(02)</option>
                                            <option value="03">Mar(03)</option>
                                            <option value="04">Apr(04)</option>
                                            <option value="05">May(05)</option>
                                            <option value="06">Jun(06)</option>
                                            <option value="07">Jul(07)</option>
                                            <option value="08">Aug(08)</option>
                                            <option value="09">Sep(09)</option>
                                            <option value="10">Oct(10)</option>
                                            <option value="11">Nov(11)</option>
                                            <option value="12">Dec(12)</option>
                                        </select>
                                        <span class="text danger" id="errorMonth"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYear" id="selectYear" class="form-control select2"
                                            data-error="#errorYear">
                                            <option value="">Year</option>
                                            @for ($i = 1990; $i <= 2050; $i++)
                                                @if ($i < 10)
                                                    <?php $i = '0' . $i; ?>
                                                @endif
                                                <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="text danger" id="errorYear"></span>
                                    </div>
                                </div>


                            </div>
                            <div class="col-12 col-md-4">
                                <label class=" form-control-label">Gender</label>
                                <select name="gender" id="" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Nationality</label>
                                <select name="nationality" id="" class="form-control">
                                    <option value="Pakistani">Pakistani</option>
                                    <option value="Non-Pakistani">Non-Pakistani</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Year of Joining</label>
                                <div class="row">
                                    <div class=" col-md-4 mb-1">
                                        <select name="selectDoJ" id="selectDoJ" class="form-control select2">
                                            <option value="0">Day</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10)
                                                    <?php $i = '0' . $i; ?>
                                                @endif
                                                <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMoJ" id="selectMoJ" class="form-control select2">
                                            <option value="0">Month</option>
                                            <option value="01">Jan(01)</option>
                                            <option value="02">Feb(02)</option>
                                            <option value="03">Mar(03)</option>
                                            <option value="04">Apr(04)</option>
                                            <option value="05">May(05)</option>
                                            <option value="06">Jun(06)</option>
                                            <option value="07">Jul(07)</option>
                                            <option value="08">Aug(08)</option>
                                            <option value="09">Sep(09)</option>
                                            <option value="10">Oct(10)</option>
                                            <option value="11">Nov(11)</option>
                                            <option value="12">Dec(12)</option>
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYoJ" id="selectYoJ" class="form-control select2"
                                            data-error="#errorYear">
                                            <option value="0">Year</option>
                                            @for ($i = 2021; $i <= 2100; $i++)
                                                @if ($i < 10)
                                                    <?php $i = '0' . $i; ?>
                                                @endif
                                                <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Year of Leaving</label>
                                <div class="row">
                                    <div class=" col-md-4 mb-1">
                                        <select name="selectDoL" id="selectDoL" class="form-control select2">
                                            <option value="0">Day</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10)
                                                    <?php $i = '0' . $i; ?>
                                                @endif
                                                <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMoL" id="selectMoL" class="form-control select2">
                                            <option value="0">Month</option>
                                            {{-- @for ($i = 1; $i <= 12; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor --}}
                                            <option value="01">Jan(01)</option>
                                            <option value="02">Feb(02)</option>
                                            <option value="03">Mar(03)</option>
                                            <option value="04">Apr(04)</option>
                                            <option value="05">May(05)</option>
                                            <option value="06">Jun(06)</option>
                                            <option value="07">Jul(07)</option>
                                            <option value="08">Aug(08)</option>
                                            <option value="09">Sep(09)</option>
                                            <option value="10">Oct(10)</option>
                                            <option value="11">Nov(11)</option>
                                            <option value="12">Dec(12)</option>
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYoL" id="selectYoL" class="form-control select2"
                                            data-error="#errorYear">
                                            <option value="0">Year</option>
                                            @for ($i = 2021; $i <= 2100; $i++)
                                                @if ($i < 10)
                                                    <?php $i = '0' . $i; ?>
                                                @endif
                                                <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Contact Details --}}
                    <div class="card-header">
                        <strong>Contact Details</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">

                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Student Contact<span
                                        class="text-danger">*</span></label>
                                <input type="text" maxlength="11" id="mobile" name="mobile" placeholder=""
                                    class="form-control" data-errorr="#errorStdContact">
                                <span class="text danger" id="errorStdContact"></span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Father Contact<span
                                        class="text-danger">*</span></label>
                                <input type="text" maxlength="11" id="phone" name="father_contact"
                                    placeholder="" class="form-control" data-errorr="#errorFathContact">
                                <span class="text danger" id="errorFathContact"></span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Student Email</label>
                                <input type="email" id="email" name="email" placeholder=""
                                    class="form-control">

                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Home Address</label>
                                <input type="text" id="address" name="address" placeholder=""
                                    class="form-control">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">City</label>
                                <select name="city" id="city" class="form-control select2">
                                    @php
                                        $cities = App\Models\City::all();
                                    @endphp
                                    <option value="">Please select</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    {{-- Course and Batch Details --}}
                    <div class="card-header">
                        <strong>Course and Batch Details</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col-12 col-md-4">
                                <label for="selectCourse" class=" form-control-label">Course<span
                                        class="text-danger">*</span></label>
                                <select name="selectCourse" id="selectCourse" class="form-control select2"
                                    data-error="#errorCourse">
                                    <option value="">Please select</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text danger" id="errorCourse"></span>
                                {{-- @error('selectCourse')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror --}}
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="selectSession" class="form-control-label">Session<span
                                        class="text-danger">*</span></label>
                                <select name="selectSession" id="selectSession" class="form-control select2"
                                    data-error="#errorSession">
                                    <option value="">Please select</option>
                                </select>
                                <span class="text danger" id="errorSession"></span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="selectShift" class="form-control-label">Shift<span
                                        class="text-danger">*</span></label>
                                <select name="selectShift" id="selectShift" class="form-control select2"
                                    data-error="#errorShift">
                                    <option value="">Please select</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text danger" id="errorShift"></span>
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-4">
                                <label for="selectBatch" class="form-control-label">Batch<span
                                        class="text-danger">*</span></label>
                                <select name="selectBatch" id="selectBatch2" class="form-control select2"
                                    data-error="#errorBatch">
                                    <option value="">Please select</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text danger" id="errorBatch"></span>
                            </div>
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">From{{-- <span class="text-danger">*</span> --}}</label>
                                <input id="timepicker1" name="from" type="text"
                                    class="timepicker1 form-control input-small">

                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">To{{-- <spanclass="text-danger">*</span> --}}</label>
                                <input id="timepicker2" name="to" type="text"
                                    class="timepicker1 form-control input-small">
                            </div>
                        </div>
                    </div>

                    {{-- Previous Education Details --}}
                    <div class="card-header">
                        <strong>Previous Educational Details</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Education</label>
                                {{-- <input type="text" id="education" name="education" placeholder="" class="form-control"
                                    data-error="#errorEducation"> --}}
                                <select name="education" id="" class="form-control select2"
                                    data-error="#errorEducation">
                                    <option value="">Please select</option>
                                    @php
                                        $educationList = App\Models\Education::all();
                                    @endphp
                                    @foreach ($educationList as $education)
                                        <option value="{{ $education->education }}">{{ $education->education }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="errorEducation"></span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Computer Knowledge</label>
                                <input type="text" id="computer_knowledge" name="computer_knowledge" placeholder=""
                                    class="form-control" data-erroe="#errorCK">
                                <span id="errorCK"></span>
                            </div>
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">How did you find out about
                                    UKICSEL?</label>
                                <input type="text" id="feedback" name="feedback" placeholder=""
                                    class="form-control">
                            </div>
                        </div>


                    </div>

                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="zmdi zmdi-save"></i> Save and proceed
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/webcam.min.js') }}"></script>
    <script language="JavaScript">
        Webcam.set({
            width: 150,
            height: 150,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                // document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                document.getElementById('showImage').src = data_uri;
            });
            document.getElementById('chooseFile').value = "";
        }
    </script>
    <script>
        $("#selectSession").prop("disabled", true);
        $("#selectShift").prop("disabled", true);
        $("#selectBatch").prop("disabled", true);


        // form validation
        $(document).ready(function() {
            // form validation
            $('#regForm').validate({
                rules: {
                    fname: {
                        required: true,
                        maxlength: 20,
                    },
                    lname: {
                        maxlength: 30,
                    },
                    father_name: {
                        required: true,
                        maxlength: 50,
                    },
                    email: {
                        email: true,
                        maxlength: 50
                    },
                    selectDay: {
                        required: true,
                    },
                    selectMonth: {
                        required: true,
                    },
                    selectYear: {
                        required: true,
                    },
                    selectBatch: {
                        required: true,
                    },
                    selectCourse: {
                        required: true,
                    },
                    selectSession: {
                        required: true,
                    },
                    selectShift: {
                        required: true,
                    },
                    father_contact: {
                        required: true,
                        digits: true,
                        maxlength: 11,
                        minlength: 11,
                    },
                    mobile: {
                        required: true,
                        digits: true,
                        maxlength: 11,
                        minlength: 11,
                    },

                },
                messages: {
                    fname: {
                        required: "First name is required",
                        maxlength: "First name cannot be more than 20 characters",
                    },
                    father_name: {
                        required: "Father name is required",
                        maxlength: "First name cannot be more than 20 characters",
                    },
                    email: {
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    },
                    selectDay: {
                        required: "Please select Day",
                    },
                    selectMonth: {
                        required: "Please select Month",
                    },
                    selectYear: {
                        required: "Please select Year",
                    },
                    selectBatch: {
                        required: "Please select a Batch",
                    },
                    selectCourse: {
                        required: "Please select a Course",
                    },
                    selectSession: {
                        required: "Please select a Session",
                    },
                    selectShift: {
                        required: "Please select a Shift",
                    },

                    father_contact: {
                        required: "Father contact is required",
                    },
                    mobile: {
                        required: "Student contact is required",
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

            // image show
            $('#chooseFile').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#showImage").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })

            // course change
            $('#selectCourse').change(function() {
                $("#selectSession").prop("disabled", false);
                $("#selectShift option:selected").prop("selected", false);
                $("#selectShift").val($("#selectShift option:first").val());
                $('#selectShift').trigger('change');
                $('#selectShift').prop("disabled", true);
                $('#selectBatch').prop("disabled", true);


                // Course id
                var id = $(this).val();
                // Empty the dropdown
                $('#selectSession').find('option').not(':first').remove();
                // AJAX request 
                $.ajax({
                    url: '/getSessions/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
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

                                $("#selectSession").append(option);
                            }
                        }

                    }
                });
            });

            // session change
            $('#selectSession').change(function() {
                $("#selectShift").prop("disabled", false);

                $("#selectShift option:selected").prop("selected", false);
                $("#selectShift").val($("#selectShift option:first").val());
                $('#selectShift').trigger('change');
                $('#selectBatch').prop("disabled", true);
                // session id
                var id = $(this).val();

                // Empty the dropdown
                $('#selectBatch').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: '/getBatches/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].batch_name;

                                var option = '<option value="' + id + '">' + name + '</option>';

                                $("#selectBatch").append(option);
                            }
                        }

                    }
                });
            });

            $("#selectShift").change(function() {
                $('#selectBatch').prop("disabled", false);

                // shift id
                var id = $(this).val();
                var session_id = $('#selectSession').val();
                console.log(session_id);
                var shiftName = $(this).find(":selected").text();
                // Empty the dropdown
                $('#selectBatch').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: '/getBatches/' + session_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].batch_name;

                                var option = '<option value="' + id + '">' + name + '</option>';

                                $("#selectBatch").append(option);
                            }
                            if (shiftName == "Morning") {
                                $("#selectBatch option:not(:contains('-M'))").not(':first')
                                    .remove();
                            } else if (shiftName == "Evening") {
                                $("#selectBatch option:not(:contains('-E'))").not(':first')
                                    .remove();
                            } else if (shiftName == "Afternoon") {
                                $("#selectBatch option:not(:contains('-A'))").not(':first')
                                    .remove();
                            }
                        }

                    }
                });
                // console.log(shiftName);


            });

            $('.timepicker1').timepicker({
                icons: {
                    up: 'fas fa-chevron-up',
                    down: 'fas fa-chevron-down'
                },
            });
        });
    </script>
@endsection
