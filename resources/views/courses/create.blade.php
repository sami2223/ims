@extends('layouts.admin')

@section('pageTitle')
    Sessions Management
@endsection
@section('pageTitle2')
    Sessions
@endsection

@section('content')

    
    <div class="row">
        
        <div class="col-md-12">
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
            {{-- Form --}}
            <form id="regForm" action="/courses" method="POST" class="form-horizontal">
                @csrf
                {{-- Session Details --}}
                <div class="card">
                    <div class="card-header">
                       
                        <h3 class="card-title">New Session</h3>
                        <div class="float-right">
                            <a class="btn btn-success" href="{{ route('courses.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Session Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    {{-- <input type="text" id="course" name="course" placeholder="" class="form-control" data-error="#errorCourse"> --}}
                                    <select name="course" id="course" class="form-control select2" data-error="#errorCourse">
                                        <option value="">Please select</option>
                                        @foreach ($course_names as $course_name)
                                        <option value="{{ $course_name->id }}">{{ $course_name->title }}</option>
                                        @endforeach
                                    </select>
                                    <span id="errorCourse"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Duration<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="number" id="duration" name="duration" placeholder="" class="form-control" data-error="#errorDur">
                                    <span id="errorDur"></span>
                                </div>
                                <div class="form-check col-md-4 d-flex align-items-center justify-content-between">
                                    <div class="radio">
                                        <label for="radio1" class="form-check-label ">
                                            <input type="radio" id="radio1" name="duration_type" value="Weeks"
                                                class="form-check-input" checked>Weeks
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="radio2" class="form-check-label ">
                                            <input type="radio" id="radio2" name="duration_type" value="Months"
                                                class="form-check-input">Months
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Teacher<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="teacher" id="teacher" class="form-control select2" data-error="#tc">
                                        <option value="">Please select</option>
                                        @if(!empty($designations))
                                        @foreach ($designations as $designation)                             
                                        @foreach ($designation->Employees as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->employee_name }}</option>        
                                        @endforeach 
                                        @endforeach      
                                        @endif
                                    </select>
                                    <span id="tc"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Start Date</label>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectDaySD" id="selectDay" class="form-control select2" data-error="#d">
                                        <option value="">Day</option>
                                        @for ($i=1; $i<=31; $i++)
                                        @if($i<10)
                                            <?php  
                                                $i = '0' . $i;
                                            ?>
                                        @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span id="d"></span>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectMonthSD" id="selectMonth" class="form-control select2" data-error="#m">
                                        <option value="">Month</option>
                                        @for ($i=1; $i<=12; $i++)
                                        @if($i<10)
                                            <?php  
                                                $i = '0' . $i;
                                            ?>
                                        @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span id="m"></span>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectYearSD" id="selectYear" class="form-control select2" data-error="#y">
                                        <option value="">Year</option>
                                        @for ($i=2021; $i<=2099; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span id="y"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="zmdi zmdi-save"></i> Save
                            </button>
                        </div>
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
                    course: {
                        required: true,
                    },
                    teacher: {
                        required: true,
                    },
                    duration: {
                        required: true,
                    },
                    selectDaySD: {
                        required: true,
                    },
                    selectMonthSD: {
                        required: true,
                    },
                    selectYearSD: {
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
        });
    </script>
@endsection