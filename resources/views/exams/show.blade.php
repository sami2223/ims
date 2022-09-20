@extends('layouts.Admin')

@section('pageTitle')
    Exams Management
@endsection
@section('pageTitle2')
    Exam - Show
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Exam Details</h3>
                    <div class="float-right">
                        <a href="{{ route('exams.index') }}" class="btn btn-success">Back</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">
                            <div class="col-md-3 text-center">
                                <p><strong>Exam Type : </strong>{{ $exam->ExamType->type }}</p>
                            </div>
                            <div class="col-md-3 text-center">
                                @if(!empty($exam->Course))
                                <p><strong>Course : </strong>{{ $exam->Course->coursename->title }}</p>
                                @else
                                <p><strong>Course : </strong></p>
                                @endif
                            </div>
                            <div class="col-md-3 text-center">
                                @if(!empty($exam->Course))
                                <p><strong>Session : </strong>{{ $exam->Course->course }}</p>
                                @else
                                <p><strong>Session : </strong></p>
                                @endif                            </div>
                            <div class="col-md-3 text-center">
                                <p><strong>Shift : </strong>{{ $exam->Shift->shift_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <h3 class="card-title"><strong>Students List :</strong></h3>
                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">
                            <div class="col-sm-12">
                                {{-- @if ()
                                    <p> No record found</p>
                                @else --}}
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Rendering engine: activate to sort column descending">
                                                S.No
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Student Name
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Father Name
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Student Reg.No.
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($exam->Students as $student)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $student->first_name.' '.$student->last_name }}</td>
                                            <td>{{ $student->father_name }}</td>
                                            <td>{{ $student->id }}</td>
                                            
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>


    <!-- page script -->

    <script>
        
    </script>

@endsection
