@extends('layouts.admin')

@section('pageTitle')
    Edit Student Details
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="d-flex align-items-center justify-content-between p-t-30 p-b-30"
            style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Student - Edit</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a class="btn btn-success" href="/students">Students List</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}}



    <div class="mt-4 d-flex justify-content-center">

        <div class="col-lg-8">
            <form id="regForm" action="{{ route('students.update', [$student->id]) }}" method="POST"
                enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="card">
                    {{-- Upload student's photo --}}
                    <div class="card-header">
                        <strong>Upload Image</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="d-flex col col-md-6 justify-content-end">
                                <div id="my_camera" class=""></div>
                                <br />
                            </div>
                            <div class="d-flex col col-md-6">
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
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">
                                    First Name<span class="text-danger">*</span>
                                </label>
                                <input type="text" id="fname" name="fname" value="{{ $student->first_name }}"
                                    class="form-control" data-error="#errorName">
                                {{-- @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text danger" id="errorName"></span>
                            </div>

                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Last Name</label>
                                <input type="text" id="lname" name="lname" value="{{ $student->last_name }}"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Father Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="father_name" name="father_name" value="{{ $student->father_name }}"
                                    class="form-control" data-error="#errorfName">

                                <span class="text danger" id="errorfName"></span>
                            </div>

                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Date of birth<span
                                        class="text-danger">*</span></label>
                                <div class="row">
                                    <div class=" col-md-4 mb-1">
                                        @php
                                            $day = date('d', strtotime($student->dob));
                                            $month = date('m', strtotime($student->dob));
                                            $year = date('Y', strtotime($student->dob));
                                        @endphp
                                        <select name="selectDay" id="selectDay" class="form-control select2"
                                            data-error="#errorDay">
                                            <option value="{{ $day }}">{{ $day }}</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="text danger" id="errorDay"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMonth" id="selectMonth" class="form-control select2"
                                            data-error="#errorMonth">
                                            <option value="{{ $month }}">{{ $month }}</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="text danger" id="errorMonth"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYear" id="selectYear" class="form-control select2"
                                            data-error="#errorYear">
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @for ($i = 1990; $i <= 2050; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span class="text danger" id="errorYear"></span>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label class=" form-control-label">Gender</label>
                                <select name="gender" id="" class="form-control">
                                    <option value="{{ $student->gender }}">{{ $student->gender }}</option>
                                    @if ($student->gender == 'Male')
                                        <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    @elseif ($student->gender == "Female")
                                        <option value="Male">Male</option>
                                        <option value="Female" selected>Female</option>
                                        <option value="Other">Other</option>
                                    @else
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other" selected>Other</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Nationality</label>
                                <select name="nationality" id="" class="form-control">
                                    @if ($student->nationality == 'Pakistani')
                                        <option value="Pakistani" selected>Pakistani</option>
                                        <option value="Non-Pakistani">Non-Pakistani</option>

                                    @else
                                        <option value="Pakistani">Pakistani</option>
                                        <option value="Non-Pakistani" selected>Non-Pakistani</option>
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                @php
                                    $day1 = 'Day';
                                    $day2 = 'Day';
                                    $month1 = 'Month';
                                    $month2 = 'Month';
                                    $year1 = 'Year';
                                    $year2 = 'Year';
                                    if (!empty($student->yoj)) {
                                        $day1 = date('d', strtotime($student->yoj));
                                        $month1 = date('m', strtotime($student->yoj));
                                        $year1 = date('Y', strtotime($student->yoj));
                                    }
                                    if (!empty($student->yol)) {
                                        $day2 = date('d', strtotime($student->yol));
                                        $month2 = date('m', strtotime($student->yol));
                                        $year2 = date('Y', strtotime($student->yol));
                                    }
                                    
                                @endphp
                                <label for="text-input" class=" form-control-label">Year of Joining</label>
                                {{-- <input type="text" id="joining_year" name="joining_year" placeholder=""
                                    class="form-control"> --}}
                                <div class="row">
                                    <div class=" col-md-4 mb-1">
                                        <select name="selectDoJ" id="selectDoJ" class="form-control select2">
                                            <option value="{{ $day1 }}">{{ $day1 }}</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMoJ" id="selectMoJ" class="form-control select2">
                                            <option value="{{ $month1 }}">{{ $month1 }}</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYoJ" id="selectYoJ" class="form-control select2"
                                            data-error="#errorYear">
                                            <option value="{{ $year1 }}">{{ $year1 }}</option>
                                            @for ($i = 1990; $i <= 2050; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-md-6">
                                <label for="text-input" class=" form-control-label">Year of Leaving</label>
                                {{-- <input type="text" id="leaving_year" name="leaving_year" placeholder=""
                                    class="form-control"> --}}
                                <div class="row">
                                    <div class=" col-md-4 mb-1">
                                        <select name="selectDoL" id="selectDoL" class="form-control select2">
                                            <option value="{{ $day2 }}">{{ $day2 }}</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMoL" id="selectMoL" class="form-control select2">
                                            <option value="{{ $month2 }}">{{ $month2 }}</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYoL" id="selectYoL" class="form-control select2"
                                            data-error="#errorYear">
                                            <option value="{{ $year2 }}">{{ $year2 }}</option>
                                            @for ($i = 1990; $i <= 2050; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
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

                            <div class="col-12 col-md-6">
                                <label for="text-input" class=" form-control-label">Student Contact<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="mobile" name="mobile" value="{{ $student->mobile }}"
                                    class="form-control" data-errorr="#errorStdContact">
                                <span class="text danger" id="errorStdContact"></span>
                            </div>
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Father Contact<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="phone" name="father_contact"
                                    value="{{ $student->father_contact }}" class="form-control"
                                    data-errorr="#errorFathContact">
                                <span class="text danger" id="errorFathContact"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-md-6">
                                <label for="text-input" class=" form-control-label">Student Email</label>
                                <input type="email" id="email" name="email" value="{{ $student->email }}"
                                    class="form-control">

                            </div>
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Home Address</label>
                                <input type="text" id="address" name="address" value="{{ $student->address }}"
                                    class="form-control">
                            </div>


                        </div>

                    </div>
                    {{-- Course and Batch Details --}}
                    <div class="d-none">
                        <div class="card-header">
                            <strong>Course and Batch Details</strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col-12 col-md-6">
                                    <label for="selectCourse" class=" form-control-label">Course<span
                                            class="text-danger">*</span></label>
                                    <select name="selectCourse" id="selectCourse" class="form-control select2"
                                        data-error="#errorCourse">

                                        <option value="">Please select</option>
                                        @foreach ($courses as $course)
                                            @if ($course->id == $student->course_id)
                                                <option value="{{ $course->id }}" selected>{{ $course->title }}
                                                </option>
                                                @continue
                                            @endif
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>

                                        @endforeach
                                    </select>
                                    <span class="text danger" id="errorCourse"></span>
                                    {{-- @error('selectCourse')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror --}}
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="selectBatch" class="form-control-label">Session<span
                                            class="text-danger">*</span></label>
                                    <select name="selectSession" id="selectSession" class="form-control select2"
                                        data-error="#errorSession">
                                        <option value="">Please select</option>
                                        @foreach ($courses as $course)
                                            {{-- @if ($course->id == $student->course_id) --}}
                                            @foreach ($course->courses as $session)
                                                @if ($session->id == $student->session_id)
                                                    <option value="{{ $session->id }}" selected>
                                                        {{ $session->course }}</option>
                                                    @continue
                                                @endif
                                                <option value="{{ $session->id }}">{{ $session->course }}</option>
                                            @endforeach
                                            {{-- @endif --}}
                                        @endforeach
                                    </select>
                                    <span class="text danger" id="errorSession"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-6">
                                    <label for="selectBatch" class="form-control-label">Batch<span
                                            class="text-danger">*</span></label>
                                    <select name="selectBatch" id="selectBatch" class="form-control select2"
                                        data-error="#errorBatch">
                                        <option value="">Please select</option>
                                        @foreach ($courses as $course)
                                            @foreach ($course->courses as $session)
                                                @if ($session->id == $student->session_id)
                                                    @foreach ($session->batches as $batch)
                                                        @if ($batch->id == $student->batch_id)
                                                            <option value="{{ $batch->id }}" selected>
                                                                {{ $batch->batch_name }}</option>
                                                            @continue
                                                        @endif
                                                        <option value="{{ $batch->id }}">
                                                            {{ $batch->batch_name }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <span class="text danger" id="errorBatch"></span>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="selectShift" class="form-control-label">Shift<span
                                            class="text-danger">*</span></label>
                                    <select name="selectShift" id="selectShift" class="form-control select2"
                                        data-error="#errorShift">
                                        <option value="">Please select</option>
                                        @foreach ($shifts as $shift)
                                            @if ($shift->id == $student->shift_id)
                                                <option value="{{ $shift->id }}" selected>{{ $shift->shift_name }}
                                                </option>
                                                @continue
                                            @endif
                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Timing Details --}}
                    <div class="">
                        <div class="card-header">
                            <strong>Timing</strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-6">
                                    <label for="text-input" class=" form-control-label">From</label>
                                    <input id="timepicker1" name="from" type="text" value="{{ $student->Timing->from }}"
                                        class="timepicker1 form-control input-small">

                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="text-input" class=" form-control-label">To{{-- <spanclass="text-danger">*</span> --}}</label>
                                    <input id="timepicker2" name="to" type="text" value="{{ $student->Timing->to }}"
                                        class="timepicker1 form-control input-small">
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Previous Education Details --}}
                    <div class="d-none">
                        <div class="card-header">
                            <strong>Previous Educational Details</strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-6">
                                    <label for="text-input" class=" form-control-label">Education</label>
                                    <input type="text" id="education" name="education"
                                        value="{{ $student->StdPreviousData->education }}" class="form-control"
                                        data-erroe="#errorEducation">
                                    <span id="errorEducation"></span>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="text-input" class=" form-control-label">Computer Knowledge</label>
                                    <input type="text" id="computer_knowledge" name="computer_knowledge"
                                        value="{{ $student->StdPreviousData->computer_knowledge }}" class="form-control"
                                        data-erroe="#errorCK">
                                    <span id="errorCK"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="text-input" class=" form-control-label">How did you find out about
                                        UKICSEL?</label>
                                    <input type="text" id="feedback" name="feedback"
                                        value="{{ $student->Feedback->feedback }}" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="zmdi zmdi-save"></i> Update
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

        }
    </script>
    <script>
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
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#showImage").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })

            // course change
            $('#selectCourse').change(function() {
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
                                var name = response['data'][i].session_name;

                                var option = '<option value="' + id + '">' + name + '</option>';

                                $("#selectSession").append(option);
                            }
                        }

                    }
                });
            });

            // session change
            $('#selectSession').change(function() {

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

            $('.timepicker1').timepicker({
                icons: {
                    up: 'fas fa-chevron-up',
                    down: 'fas fa-chevron-down'
                },
            });

        });
    </script>

@endsection
