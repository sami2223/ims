@extends('layouts.admin')
@section('pageTitle')
    Exams Management
@endsection

@section('content')



    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $student->first_name .' '. $student->last_name }} - Exams List</h3>
                    <div class="float-right">
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-success">
                            Back
                        </a>
                    </div>
                </div>
                
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12">
                                    @if (count($student->Exams) == 0)
                                        <p>No record found</p>
                                    @else
                                        <div class="table responsive">
                                            <table id="example1" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Exam Type</th>
                                                        <th>Course</th>
                                                        <th>Shift</th>
                                                        <th>Session</th>
                                                        <th>Teacher</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($student->Exams as $exam)

                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>
                                                            {{ $exam->ExamType->type }}
                                                        </td>
                                                        <td>
                                                            @if (!empty($exam->Course))
                                                                {{ $exam->Course->course }}
                                                            @endif

                                                        </td>
                                                        <td>

                                                            {{ $exam->Shift->shift_name }}
                                                        </td>
                                                        <td>
                                                            {{ $exam->Session->session_name }}
                                                        </td>
                                                        <td>
                                                            @if (!empty($exam->Course))
                                                                {{ $exam->Course->Teacher->employee_name }}
                                                            @endif

                                                        </td>

                                                    </tr>
                                                        
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                

            </div>
        </div>

        <div class="mt-3 d-flex justify-content-center flex-column align-items-center">

            <div class="col-md-12">
                <!-- DATA TABLE -->

                <div class="">


                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>

        <script>
            // for post method
            $('.delete-confirm').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                        title: `Are you sure to delete this record?`,
                        text: "This record will be permanantly deleted!",
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
        </script>

    @endsection
