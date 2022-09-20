@extends('layouts.Admin')

@section('pageTitle')
    Sessions Management
@endsection

@php
$course_names = App\Models\CourseNames::all();
$designations = App\Models\Designation::where('designation_name', 'like', '%Teacher%')->get();
@endphp

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New Session</h3>
                </div>
                <div class="card-body">
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
                    <form id="regForm" action="{{ route('courses.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Course<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        {{-- <input type="text" id="course" name="course" placeholder="" class="form-control" data-error="#errorCourse"> --}}
                                        <select name="course" id="course" class="form-control select2"
                                            data-error="#errorCourse">
                                            <option value="">Please select</option>
                                            @foreach ($course_names as $course_name)
                                                <option value="{{ $course_name->id }}">{{ $course_name->code }}</option>
                                            @endforeach
                                        </select>
                                        <span id="errorCourse"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Duration<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="number" id="duration" name="duration" placeholder="" class="form-control"
                                                    data-error="#errorDur">
                                                <span id="errorDur"></span>
                                            </div>
                                            <div class="form-check col-md-7 d-flex align-items-center justify-content-between">
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
                                    </div>
                                </div>                               
                            </div>
                            <div class=" form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Teacher<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <select name="teacher" id="teacher" class="form-control select2" data-error="#tc">
                                            <option value="">Please select</option>
                                            @if (!empty($designations))
                                                @foreach ($designations as $designation)
                                                    @foreach ($designation->Employees as $teacher)
                                                        <option value="{{ $teacher->id }}">{{ $teacher->employee_name }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="tc"></span>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Start Date</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-4 mb-1">
                                                <select name="selectDaySD" id="selectDay" class="form-control select2" data-error="#d">
                                                    <option value="">Day</option>
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        @if ($i < 10)
                                                            <?php
                                                            $i = '0' . $i;
                                                            ?>
                                                        @endif
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                <span id="d"></span>
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <select name="selectMonthSD" id="selectMonth" class="form-control select2"
                                                    data-error="#m">
                                                    <option value="">Month</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        @if ($i < 10)
                                                            <?php
                                                            $i = '0' . $i;
                                                            ?>
                                                        @endif
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                <span id="m"></span>
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <select name="selectYearSD" id="selectYear" class="form-control select2"
                                                    data-error="#y">
                                                    <option value="">Year</option>
                                                    @for ($i = 2021; $i <= 2099; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                <span id="y"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-md-8">

                                    </div>
                                    <div class="col-12 col-md-4 ">
                                        <button type="submit" class="btn btn-primary btn-block float-right">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sessions List</h3>
                    {{-- <div class="float-right">
                    <a class="btn btn-success" href="{{ route('courses.create') }}">
                        Create New
                    </a>
                </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">
                            <div class="col-sm-12">
                                @if (count($courses) == 0)
                                    <p> No record found</p>
                                @else
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        role="grid" aria-describedby="example1_info">

                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    SNo</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">
                                                    Session
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Duration</th>

                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Start Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    End Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Teacher
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($courses as $course)
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">{{ ++$i }}</td>
                                                    <td>{{ $course->course }}</td>
                                                    <td>{{ $course->duration }}</td>

                                                    <td>{{ $course->start_date }}</td>
                                                    <td>{{ $course->end_date }}</td>
                                                    <td>
                                                        @if (!empty($course->teacher->employee_name))
                                                            {{ $course->teacher->employee_name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <!-- Delete functionality -->
                                                        <form action="courses/{{ $course->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <!-- Edit functionality -->
                                                            <a href="courses/{{ $course->id }}/edit"
                                                                class="btn btn-primary">
                                                                {{-- <i class="fas fa-edit"></i> --}}
                                                                Edit
                                                            </a>

                                                            <!-- Show Details -->
                                                            {{-- <a href="courses/{{ $course->id }}" class="btn btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a> --}}
                                                            <button type="submit" class="btn btn-danger delete-confirm">
                                                                {{-- <i class="fas fa-trash"></i> --}}
                                                                Delete
                                                            </button>
                                                        </form>
                                                        <!-- Delete functionality End -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
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
