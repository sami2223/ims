@extends('layouts.app')

@section('pageTitle')
    Update Gaurdian
@endsection

@section('content')    

{{-- Content Header --}}
<section>
    <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
        <div class="float-left">
            <h4>Parent/Gaurdian - Update</h4>
        </div>

        <div class="float-right">
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
                                    <a href="/students/{{ $parent->student->id }}">{{ $parent->student->first_name }}</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item active">
                                    Parent/Guardian update
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->

    <div class="container-fluid d-flex justify-content-center">

        <div class="col-lg-8">


            <form id="regForm" action="{{ route('students.updateParent', [$parent->id]) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('put')
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
                                <input type="text" id="fname" name="fname" value="{{ $parent->first_name }}" class="form-control" data-error="#errorfName">
                                <span class="text danger" id="errorfName"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Last Name</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="lname" name="lname" value="{{ $parent->last_name }}" class="form-control">
                            </div>
                        </div>

                        
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Relation<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-6">
                                <select name="relation" id="relation" class="form-control select2" data-error="#errorRelation">
                                    @if($parent->relation == 'Father')
                                        
                                        <option value="Father" selected>Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Other">Other</option>
                                    @elseif($parent->relation == 'Mother')
                                        
                                        <option value="Father">Father</option>
                                        <option value="Mother" selected>Mother</option>
                                        <option value="Other">Other</option>
                                    @else
                                        
                                        <option value="Father">Father</option>
                                        <option value="Mother" selected>Mother</option>
                                        <option value="Other" selected>Other</option>
                                    @endif
                                </select>
                                <span class="text danger" id="errorRelation"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Date of birth</label>
                            </div>
                                <?php 
                                        $day = date('d', strtotime($parent->dob)); 
                                        $month = date('m', strtotime($parent->dob));
                                        $year = date('Y', strtotime($parent->dob));   
                                    ?>
                            <div class="col-12 col-md-2 mb-2">
                                <select name="selectDay" id="selectDay" class="form-control select2">
                                    
                                    <option value="{{ $day }}">{{ $day }}</option>
                                    @for ($i=1; $i<=31; $i++)
                                    @if($i<10)
                                        <?php  
                                            $i = '0' . $i;
                                        ?>
                                    @endif
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-2">
                                <select name="selectMonth" id="selectMonth" class="form-control select2">
                                    <option value="{{ $month }}">{{ $month }}</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                    @if($i<10)
                                    <?php  
                                        $i = '0' . $i;
                                    ?>
                                @endif
                                <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-2">
                                <select name="selectYear" id="selectYear" class="form-control select2">
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @for ($i = 1990; $i <= 2050; $i++)
                                    @if($i<10)
                                    <?php  
                                        $i = '0' . $i;
                                    ?>
                                @endif
                                <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Education</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="education" name="education" value="{{ $parent->education }}" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Occupation</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="occupation" name="occupation" value="{{ $parent->occupation }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Income</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="income" name="income" value="{{ $parent->income }}" class="form-control">
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
                                <input type="email" id="email" name="email" value="{{ $parent->address->email }}" class="form-control" data-error="#errorEmail">
                                <span id="errorEmail"></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Office Address Line 1</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="officeAddress1" name="officeAddress1" value="{{ $parent->address->address_one }}" class="form-control">
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
                                <input type="text" id="officeAddress2" name="officeAddress2" value="{{ $parent->address->address_two }}" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">City</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="city" name="city" value="{{ $parent->address->city }}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">State</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="state" name="state" value="{{ $parent->address->state }}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">PIN Code</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="pin_code" name="pin_code" value="{{ $parent->address->pin_code }}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Country</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="country" name="country" value="{{ $parent->address->country }}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Phone</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="phone" name="phone" value="{{ $parent->address->phone }}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Mobile</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="mobile" name="mobile" value="{{ $parent->address->mobile }}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Office Phone</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" id="officePhone" name="officePhone" value="{{ $parent->address->officePhone }}" class="form-control">
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
                                <label for="text-input" class=" form-control-label">Old Image</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="hidden" name="old_image" value="{{ $parent->image }}">
                                <img class="profile_img" src="{{ URL($parent->image) }}" alt="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Upload New</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="file" id="photo" name="photo" class="form-control-file" data-error="#errorImage">
                                <span id="errorImage"></span>
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
