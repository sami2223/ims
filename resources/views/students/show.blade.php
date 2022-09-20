@extends('layouts.admin')

@section('pageTitle')
    Students Management
@endsection

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Profile</h3>
                    <div class=" float-right">
                        <!-- Delete functionality -->
                        <form class="d-flex justify-content-between" action="/students/{{ $student->id }}" method="POST">
                            <a href="/students/{{ $student->id }}/edit" class="btn btn-success mx-1">
                                </i>Edit
                            </a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1 delete-confirm"
                                data-name="{{ $student->first_name }}">
                                Delete
                            </button>
                        
                        <a class="btn btn-info mx-1" href="{{ route('fees.show', [$student->id]) }}">Fee Details</a>
                        <a class="btn btn-info mx-1" href="{{ route('exams.showStudentExams', [$student->id]) }}">Exams</a>
                        <a class="btn btn-success ml-1" href="{{ route('students.index') }}">Back</a>

                    </form>
                    <!-- End Delete functionality -->
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
                                                <td class="d-flex justify-content-end">
                                                    <div class="profile_picture_display">
                                                        <img class="profile_img" src="{{ URL($student->image) }}" alt="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="profile_info" style="padding-top: 0px;">
                                                        <h4 style="color: #ab0000">
                                                            {{ $student->first_name . ' ' . $student->last_name }}
                                                        </h4>
                                                        @if(!empty($student->Course))
                                                            <h6><strong> Course : </strong>{{ $student->Course->CourseName->title }}</h6>
                                                            <h6><strong> Session : </strong>{{ $student->Course->course }}</h6>
                                                            <h6><strong> Batch : </strong>{{ $student->Batch->batch_name }}</h6>
                                                            <h6><strong> Shift : </strong>{{ $student->Shift->shift_name }}</h6>
                                                        @else
                                                            <h6>Course : </h6>
                                                            <h6>Session : </h6>
                                                            <h6>Batch : </h6>
                                                        @endif
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Reg No.</td>
                                                <td>{{ $student->reg_no }}</td>
                                            </tr>
                                            <tr>
                                                <td>Father Name</td>
                                                <td>{{ $student->father_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Father Contact</td>
                                                <td>{{ $student->father_contact }}</td>
                                            </tr>
                                            @php
                                                $ad_date =  date('d-M-Y', strtotime($student->created_at));
                                            @endphp
                                            <tr>
                                                <td>Admission Date</td>
                                                <td>{{ $ad_date }}</td>
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
                                                <td>City</td>
                                                <td>{{ $student->city }}</td>
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
                                                <td>Timing</td>
                                                <td>{{ $student->Timing->from.' - '.$student->Timing->to }}</td>
                                            </tr>
                                            <tr>
                                                <td>Code</td>
                                                <td>{{ $student->code }}</td>
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
                                                <script>
                                                    var predata = document.getElementById('preData');
                                                    predata.innerHTML += ' <a href="' + "{{ route('students.editPreviousData', [$student->id]) }}" + '">(Edit)</a>';
                                                </script>
                                                {{-- End Javascrip --}}
                                            @else
                                                <tr>
                                                    <td></td>
                                                    <td>No previous data <a href="{{ route('students.previousData', [$student->id]) }}">
                                                            (Add here)</a></td>
                                                </tr>
                                            @endif
                
                                        </tbody>
                                    </table>
                                </div>
                
                                <div class="d-flex justify-content-center mt-4">
                
                                    {{-- <a target="_blank" href="/students/studentDetailsPDF/{{ $student->id }}" class="au-btn au-btn-icon au-btn--green au-btn--small ml-2">
                                        <i class="zmdi zmdi-print"></i>print
                                    </a> --}}
                                </div>
                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script>
        // for post method
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete ${name}?`,
                    text: "This record and it's related data will be permanantly deleted!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,

                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        // for get mthode
        // $('.delete-confirm').on('click', function(event) {
        //     event.preventDefault();
        //     const url = $(this).attr('href');
        //     swal({
        //         title: 'Are you sure?',
        //         text: 'This record and it`s details will be permanantly deleted!',
        //         icon: 'warning',
        //         buttons: ["Cancel", "Yes!"],
        //     }).then(function(value) {
        //         if (value) {
        //             window.location.href = url;
        //         }
        //     });
        // });
    </script>

@endsection
