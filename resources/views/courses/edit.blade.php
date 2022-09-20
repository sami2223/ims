@extends('layouts.admin')

@section('pageTitle')
    Sessions Management
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
            <form id="regForm" action="/courses/{{ $course->id }}" method="post" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update Session</h3>
                        <div class="float-right">
                            <a class="btn btn-success" href="{{ route('courses.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="col-md-8">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Session Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    {{-- <input type="text" id="course" name="course" value="{{ $course->course }}" class="form-control" data-error="#errorCourse"> --}}
                                    <select name="course" id="course" class="form-control select2" data-error="#errorCourse" disabled>
                                        <option value="{{ $course->course }}">{{ $course->course }}</option>
                                        @foreach ($course_names as $course_name)
                                        @if($course->course ==  $course_name->title)
                                            @continue                                        
                                        @endif
                                        <option value="{{ $course_name->title }}">{{ $course_name->title }}</option>
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
                                    @php
                                        $int = (int) filter_var($course->duration, FILTER_SANITIZE_NUMBER_INT);
                                        $result = preg_replace("/[^a-zA-Z]+/", "", $course->duration);
                                    @endphp
                                    <input type="number" id="duration" name="duration" value="{{ $int }}" class="form-control" data-error="#errorDur">
                                    <span id="errorDur"></span>
                                </div>
                                <div class="form-check col-md-4">
                                    <div class="row">
                                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <div class="radio">
                                            <label for="radio2" class="form-check-label ">
                                                @if($result == 'Weeks')
                                                <input type="radio" id="radio2" name="duration_type" value="Weeks"
                                                class="form-check-input" checked>Weeks
                                                @else
                                                <input type="radio" id="radio2" name="duration_type" value="Weeks"
                                                class="form-check-input">Weeks
                                                @endif
                                                
                                            </label>
                                        </div></div>
                                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <div class="radio">
                                            <label for="radio1" class="form-check-label ">
                                                @if($result == 'Months')
                                                <input type="radio" id="radio1" name="duration_type" value="Months"
                                                    class="form-check-input" checked>Months
                                                @else
                                                <input type="radio" id="radio1" name="duration_type" value="Months"
                                                    class="form-check-input">Months
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Teacher</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="teacher" id="teacher" class="form-control select2">
                                        @if(!empty($currentTeacher))
                                            <option value="{{ $currentTeacher->id }}">{{ $currentTeacher->employee_name }}</option>
                                            
                                            @foreach($designations as $designation)
                                                @foreach ($designation->Employees as $teacher)
                                                    @if($currentTeacher->id==$teacher->id)
                                                        @continue
                                                    @endif
                                                    <option value="{{ $teacher->id }}">{{ $teacher->employee_name }}</option>        
                                                @endforeach
                                            @endforeach
                                        @else
                                        <option value="">Please select</option>
                                        @foreach($designations as $designation)
                                                @foreach ($designation->Employees as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->employee_name }}</option>        
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Start Date</label>
                                </div>
                                <?php 
                                    // start date
                                    $sdDay = date('d', strtotime($course->start_date)); 
                                    $sdMonth = date('m', strtotime($course->start_date));
                                    $sdYear = date('Y', strtotime($course->start_date)); 
                                    
                                    // end date
                                    $endDay = date('d', strtotime($course->end_date)); 
                                    $endMonth = date('m', strtotime($course->end_date));
                                    $endYear = date('Y', strtotime($course->end_date));
                                ?>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectDaySD" id="selectDay" class="form-control select2">
                                        <option value="{{ $sdDay }}" selected>{{ $sdDay }}</option>
                                        @for ($i=1; $i<=31; $i++)
                                        @if($i==$sdDay)
                                                @continue
                                            @endif
                                        @if($i<10)
                                            <?php  
                                                $i = '0' . $i;
                                            ?>
                                        @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectMonthSD" id="selectMonth" class="form-control select2">
                                        <option value="{{ $sdMonth }}" selected>{{ $sdMonth }}</option>
                                        @for ($i=1; $i<=12; $i++)
                                        @if($i==$sdMonth)
                                                @continue
                                            @endif
                                        @if($i<10)
                                            <?php  
                                                $i = '0' . $i;
                                            ?>
                                        @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectYearSD" id="selectYear" class="form-control select2">
                                        <option value="{{ $sdYear }}" selected>{{ $sdYear }}</option>
                                        @for ($i=2021; $i<=2099; $i++)
                                        @if($i==$sdYear)
                                                @continue
                                            @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">End Date</label>
                                </div>
                                <div class="col-12 col-md-2 mb-1">
                                    <select name="selectDayED" id="selectDay" class="form-control select2">
                                        <option value="{{ $endDay }}" selected>{{ $endDay }}</option>
                                        @for ($i=1; $i<=31; $i++)
                                        @if($i==$endDay)
                                                @continue
                                            @endif
                                        @if($i<10)
                                            <?php  
                                                $i = '0' . $i;
                                            ?>
                                        @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectMonthED" id="selectMonth" class="form-control select2">
                                        <option value="{{ $endMonth }}" selected>{{ $endMonth }}</option>
                                        @for ($i=1; $i<=12; $i++)
                                        @if($i==$endMonth)
                                                @continue
                                            @endif
                                        @if($i<10)
                                            <?php  
                                                $i = '0' . $i;
                                            ?>
                                        @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectYearED" id="selectYear" class="form-control select2">
                                        <option value="{{ $endYear }}" selected>{{ $endYear }}</option>
                                        @for ($i=2021; $i<=2099; $i++)
                                            @if($i==$endYear)
                                                @continue
                                            @endif
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div> --}}
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
                    course: {
                        required: true,
                    },
                    duration: {
                        required: true,
                    },
                    teacher: {
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