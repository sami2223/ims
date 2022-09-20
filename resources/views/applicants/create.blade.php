@extends('layouts.app')

@section('pageTitle')
    New Admission
@endsection

@section('content')    

{{-- Content Header --}}
<section>
    <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
        <div class="float-left">
            <h4>Admission - New Student</h4>
        </div>

        <div class="float-right">
            <a class="btn btn-success mx-1" href="/students">Students List</a>
        </div>
    </div>
</section>
{{-- End Content Header --}}

    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="{{ URL('/') }}">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item">
                                    New Admission
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->
    <div class="block text-center mb-4">
        <h2>NEW ADMISSION</h2>
    </div>

    <div class="container-fluid d-flex justify-content-center">

        <div class="col-lg-8">
            <form id="regForm" action="/students" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                {{-- Personal Details --}}
                <div class="card">
                    <div class="card-header">
                        <strong>Student - Personal Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">
                                    First Name<span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="fname" name="fname" placeholder="" class="form-control" data-error="#errorName">
                                {{-- @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text danger" id="errorName"></span>
                            </div>
                            
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Midle Name</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="mname" name="mname" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Last Name</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="lname" name="lname" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Date of birth<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-2 mb-1">
                                <select name="selectDay" id="selectDay" class="form-control select2" data-error="#errorDay">
                                    <option value="">Day</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">{{ $i }}
                                            </option>
                                    @endfor
                                </select>
                                <span class="text danger" id="errorDay"></span>
                            </div>
                            <div class="col-12 col-md-2 mb-1">
                                <select name="selectMonth" id="selectMonth" class="form-control select2" data-error="#errorMonth">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <span class="text danger" id="errorMonth"></span>
                            </div>
                            <div class="col-12 col-md-2 mb-1">
                                <select name="selectYear" id="selectYear" class="form-control select2" data-error="#errorYear">
                                    <option value="">Year</option>
                                    @for ($i = 1990; $i <= 2050; $i++)
                                        @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">{{ $i }}
                                            </option>
                                    @endfor
                                </select>
                                <span class="text danger" id="errorYear"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label class=" form-control-label">Gender</label>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-check">
                                    <div class="radio">
                                        <label for="radio1" class="form-check-label ">
                                            <input type="radio" id="radio1" name="gender" value="Male"
                                                class="form-check-input" checked>Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="radio2" class="form-check-label ">
                                            <input type="radio" id="radio2" name="gender" value="Female"
                                                class="form-check-input">Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Blood Group</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <select name="selectBloodGroup" id="selectBloodGroup" class="form-control select2">
                                    <option value="Unknown">Unknown</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Birth Place</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="birthPlace" name="birthPlace" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Nationality</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="nationality" name="nationality" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Mother Tongue</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="motherTongue" name="motherTongue" placeholder=""
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Category</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <select name="selectCategory" id="selectCategory" class="form-control select2">
                                    <option value="0">Please select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Religion</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="religion" name="religion" placeholder="" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Contact Details --}}
                <div class="card">
                    <div class="card-header">
                        <strong>Contact Details</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Address Line 1</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="address1" name="address1" placeholder="" class="form-control">
                                @error('address1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Address Line 2</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="address2" name="address2" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">City</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="city" name="city" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">State</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="state" name="state" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">PIN Code</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="pin_code" name="pin_code" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Country</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="country" name="country" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Phone</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="phone" name="phone" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Mobile</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="mobile" name="mobile" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Email</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="email" id="email" name="email" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Course and Batch Details --}}
                <div class="card">
                    <div class="card-header">
                        <strong>Course and Batch Details</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="selectCourse" class=" form-control-label">Course<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-6">
                                <select name="selectCourse" id="selectCourse" class="form-control select2"
                                    data-error="#errorCourse">
                                    <option value="">Please select</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course }}</option>
                                    @endforeach
                                </select>
                                <span class="text danger" id="errorCourse"></span>
                                {{-- @error('selectCourse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="selectBatch" class="form-control-label">Batch<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-6">
                                <select name="selectBatch" id="selectBatch" class="form-control select2" data-error="#errorBatch">
                                    <option value="">Please select</option>
                                </select>
                                <span class="text danger" id="errorBatch"></span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Settings --}}
                <div class="card">
                    <div class="card-header">
                        <strong>Settings</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Biometric ID</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="biometricId" name="biometricId" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Enable email features</label>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-check">
                                    <div class="checkbox">
                                        <label for="male" class="form-check-label ">
                                            <input type="checkbox" id="emailFeatures" name="emailFeatures" value="1"
                                                class="form-check-input">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Assign Transport</label>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-check">
                                    <div class="checkbox">
                                        <label for="male" class="form-check-label ">
                                            <input type="checkbox" id="transport" name="transport" value="1"
                                                class="form-check-input">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Upload student's photo --}}
                <div class="card">
                    <div class="card-header">
                        <strong>Upload student's image</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Upload image</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="file" id="photo" name="photo" class="form-control-file" data-error="#errorPhoto">
                                {{-- @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text danger" id="errorPhoto"></span>
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


    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    fname: {
                        required: true,
                        maxlength: 20,
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
                    selectCourse: {
                        required: true,
                    },
                    selectBatch: {
                        required: true,
                    },
                    photo: {
                        extension: "jpg|jpeg|png|gif"
                    },

                },
                messages: {
                    fname: {
                        required: "First name is required",
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
                    selectCourse: {
                        required: "Please select a Course",
                    },
                    selectBatch: {
                        required: "Please select a Batch",
                    },
                    photo: {
                        extension: "Allowed extensions are jpg, jpeg, png and gif"
                    }
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
        });

        $(document).ready(function() {
            // course change
            $('#selectCourse').change(function() {

                // Course id
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
        });
    </script>
@endsection
