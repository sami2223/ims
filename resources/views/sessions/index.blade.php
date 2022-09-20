@extends('layouts.admin')
@section('pageTitle')
    Sessions Management
@endsection

@section('content')



    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">Sessions Details</h3>
                    <div class=" float-right">
                        <a href="{{ route('sessions.create') }}" class="btn btn-success">
                            Add New Session</a>
                    </div>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($sessions) == 0)
                            <p>No record found</p>
                        @else
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Session</th>
                                    <th>Course</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($sessions as $session)
        
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            {{ $session->session_name }}
                                        </td>
                                        <td>
                                            {{ $session->course->course }}
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <form action="sessions/{{ $session->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <a href="sessions/{{ $session->id }}/edit" class="btn btn-success">
                                                    <i class="zmdi zmdi-edit"></i>Edit
                                                </a>
                                                <!-- Delete functionality -->
                                                
                                                    <button type="submit" class="btn btn-danger delete-confirm" data-name="{{ $session->session_name }}" data-toggle="tooltip" data-placement="top"
                                                        data-original-title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>Delete
                                                    </button>
                                                </form>
                                                <!-- Delete functionality End -->
                                            </div>
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
    </div>




    <script>
        // for post method
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure to delete ${name}?`,
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
