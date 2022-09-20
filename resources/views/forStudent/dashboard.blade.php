@extends('layouts.student')

@section('pageTitle')
    Student Dashboard
@endsection

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <p>Welcome... You are logged in as <strong>{{ auth()->user()->name }}</strong>.</p>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Profile</h3>
                        <div class="float-right">   
                            <a class="btn btn-info mx-1" href="{{ route('stdPaymentsHistory', [$student->id]) }}">
                                My Payments History 
                                {{-- <i class="fas fa-arrow-right"></i> --}}
                            </a>
                            {{-- <a class="btn btn-info mx-1" href="#">Exams</a> --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <div class="d-flex justify-content-center flex-column align-items-center">
    
                            <div class="col-md-8">
                                <!-- DATA TABLE -->
                                <div class="top-campaign">
                    
                                    <div class="">
                                        <table class="table table-top-campaign" style="padding: 20px;">
                                            <tbody>
                                                <tr>
                                                    <td class="d-flex justify-content-end" style="margin-bottom: -1px;">
                                                        <div class="profile_picture_display">
                                                            <img class="profile_img" src="{{ URL($student->image) }}" alt="">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="profile_info">
                                                            <h5 style="color: #ab0000">
                                                                {{ $student->first_name . ' ' . $student->last_name }}
                                                            </h5>
                                                            @if(!empty($student->course))
                                                                <h6>Course : {{ $student->Course->CourseName->title }}</h6>
                                                                <h6>Session : {{ $student->Course->course }}</h6>
                                                                <h6>Shift : {{ $student->Shift->shift_name }}</h6>
                                                                <h6>Teacher : {{ $student->course->teacher->employee_name }}</h6>
                                                            @else
                                                                <h6>Course : </h6>
                                                                <h6>Session : </h6>
                                                                <h6>Batch : </h6>
                                                                <h6>Teacher : </h6>
                                                            @endif
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Admn No.</td>
                                                    <td>{{ $student->id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Date</td>
                                                    <td>{{ $student->created_at }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Father Name</td>
                                                    <td>{{ $student->father_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Father Contact</td>
                                                    <td>{{ $student->father_contact }}</td>
                                                </tr>
                                                
                    
                                                <tr>
                                                    <td>Date of Birth</td>
                                                    <td>{{ $student->dob }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td>{{ $student->gender }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nationality</td>
                                                    <td>{{ $student->nationality }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>{{ $student->address }}</td>
                                                </tr>
                    
                                                <tr>
                                                    <td>Mobile</td>
                                                    <td>{{ $student->mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>{{ $student->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Code</td>
                                                    <td>{{ $student->code }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Timing</td>
                                                    <td>{{ $student->Timing->from.' - '.$student->Timing->to }}</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><strong id="preData">Previous Record</strong></td>
                                                </tr>
                                                <?php
                                                use App\Models\StdPreviousData;
                                                $previousData = StdPreviousData::where('student_id', $student->id)->first();
                                                
                                                ?>
                                                @if (!empty($previousData) || $previousData != null)
                                                    <tr>
                                                        <td>Education</td>
                                                        <td>{{ $previousData->education }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Computer knowledge</td>
                                                        <td>{{ $previousData->computer_knowledge }}</td>
                                                    </tr>
                    
                                                    {{-- Javascrip --}}
                                                    {{-- <script>
                                                        var predata = document.getElementById('preData');
                                                        predata.innerHTML += ' <a href="' + "{{ route('students.editPreviousData', [$student->id]) }}" + '">(Edit)</a>';
                                                    </script> --}}
                                                    {{-- End Javascrip --}}
                                                @else
                                                    <tr>
                                                        <td></td>
                                                        <td>No previous data</td>
                                                    </tr>
                                                @endif
                    
                                            </tbody>
                                        </table>
                                    </div>
                    
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
