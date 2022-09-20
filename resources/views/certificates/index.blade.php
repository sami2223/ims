@extends('layouts.admin')

@section('pageTitle')
    Certificates Management
@endsection

@section('content')



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Issued Certificates List</h3>
                
            </div>
            <!-- /.card-body -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            @if (count($certificates) == 0)
                                <p> No record found</p>
                            @else
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Image</th>
                                                <th>Student Name</th>
                                                <th>Father Name</th>
                                                <th>Reg No.</th>
                                                {{-- <th>Course</th> --}}
                                                <th>Certificate Type</th>
                                                <th>Received By</th>
                                                <th>Received Date</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($certificates as $certificate)

                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>
                                                        <img class="std_img" src="{{ $certificate->student->image }}" alt="">
                                                    </td>
                                                    <td>
                                                        {{ $certificate->student->first_name . ' ' . $certificate->student->last_name }}
                                                    </td>
                                                    
                                                    <td>
                                                        {{ $certificate->student->father_name }}
                                                    </td>
                                                    <td>{{ $certificate->student->reg_no }}</td>
                                                    {{-- @if(!empty($certificate->student->course))
                                                    <td>{{ $certificate->student->course->course }}</td>
                                                    @else
                                                    <td></td>
                                                    @endif --}}
                                                        
                                                    <td>{{ $certificate->CertType->cert_type }}</td>                                                    
                                                    <td>{{ $certificate->received_by }}</td> 
                                                    <td>{{ $certificate->issue_date }}</td>                                                                                         
                                                    <td>
                                                        <form action="{{ route('certificates.destroy', $certificate->id)  }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
        
                                                            <!-- Edit functionality -->
                                                            <a href="{{ route('certificates.edit', [$certificate->id]) }}"
                                                                class="btn btn-primary btn-block">
                                                                <i class="zmdi zmdi-edit"></i>Edit
                                                            </a>
                                                            <!-- Delete functionality -->
        
                                                            <button type="submit" class="btn btn-danger btn-block delete-confirm">
                                                                Delete
                                                            </button>
                                                        </form>                                                       
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
            <!-- /.card-body -->
        </div>
    </div>
</div>



@endsection