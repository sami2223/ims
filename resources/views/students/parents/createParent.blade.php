@extends('layouts.app')

@section('pageTitle')
    Add Student Gaurdian
@endsection

@section('content')    

{{-- Content Header --}}
<section>
    <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
        <div class="float-left">
            <h4>Student - Add Parent/Gaurdian</h4>
        </div>

        <div class="float-right">
            {{-- <a class="btn btn-success mx-1" href="/students/{{ $student->id }}">View Profile</a> --}}
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
                                <li class="list-inline-item active">
                                    <a href="{{ URL('/students') }}">Students</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                
                                <li class="list-inline-item active">
                                    <a href="/students/{{ $student->id }}">{{ $student->first_name }}</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item active">
                                    Parent/Guardian details
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->
    <div class="container block text-center mb-4" style="background: rgb(144, 34, 34); color: white">
        <p>{{ session('successMsg') }}</p>
    </div>

    <div class="container-fluid d-flex justify-content-center">

        <div class="col-lg-8">

            <div class="card">
                
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-6">
                            <label for="text-input" class=" form-control-label">Student Registration ID</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" id="studentId" name="studentId" value="{{ $student->id }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <form id="regForm" action="/students/storeParent/{{ $student->id }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                
                {{-- Personal Details --}}
                <div class="card">
                    <div class="card-header">
                        <strong>Parent - Personal Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">First Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="fname" name="fname" placeholder="" class="form-control" data-error="#errorfName">
                                {{-- @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text danger" id="errorfName"></span>
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
                                <label for="text-input" class=" form-control-label">Relation<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-6">
                                <select name="relation" id="relation" class="form-control select2" data-error="#errorRelation">
                                    <option value="">Please select</option>
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="text danger" id="errorRelation"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Date of birth</label>
                            </div>
                            <div class="col-12 col-md-2 mb-1">
                                <select name="selectDay" id="selectDay" class="form-control select2">
                                    @for ($i = 1; $i <= 31; $i++)
                                        @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">{{ $i }}
                                            </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-1">
                                <select name="selectMonth" id="selectMonth" class="form-control select2">
                                    @for ($i = 1; $i <= 12; $i++)
                                        @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">{{ $i }}
                                            </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-1">
                                <select name="selectYear" id="selectYear" class="form-control select2">
                                    @for ($i = 1970; $i <= 2050; $i++)
                                        @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">{{ $i }}
                                            </option>
                                    @endfor
                                </select>
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Education</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="education" name="education" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Occupation</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="occupation" name="occupation" placeholder=""
                                    class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Income</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="income" name="income" placeholder="" class="form-control">
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
                                <label for="text-input" class=" form-control-label">Email</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="email" id="email" name="email" placeholder="" class="form-control" data-error="#errorEmail">
                                <span id="errorEmail"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Office Address Line 1</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="officeAddress1" name="officeAddress1" placeholder="" class="form-control">
                                @error('address1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Office Address Line 2</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="officeAddress2" name="officeAddress2" placeholder="" class="form-control">
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
                                <label for="text-input" class=" form-control-label">Office Phone</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="officePhone" name="officePhone" placeholder="" class="form-control">
                            </div>
                        </div>

                        
                    </div>

                </div>

                {{-- Upload parent's photo --}}
                <div class="card">
                    <div class="card-header">
                        <strong>Upload parent's image</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Upload image</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="file" id="photo" name="photo" class="form-control-file" data-error="#errorImage">
                                {{-- @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span id="errorImage"></span>
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
                    relation: {
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
                    relation: {
                        required: "Please select relation",
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

    </script>

@endsection
