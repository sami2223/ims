@extends('layouts.admin')
@section('pageTitle')
    Courses Management
@endsection

@section('content')

    {{-- Form --}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">New Course</span>
                    </div>
                    <div class="card-body card-block">
                        <div>
                            <form id="regForm" action="{{ route('courseNames.store') }}" method="post"
                                class="form-horizontal">
                                @csrf
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
                                
                                <div class="form-group">
                                    <div class="">
                                        <div class="col">
                                            <label for="text-input" class=" form-control-label">Code<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" id="code" name="code" placeholder="Enter course code..."
                                                class="form-control" data-error="#errorAz" required>
                                            <span id="errorAz"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="">
                                        <div class="col">
                                            <label for="text-input" class=" form-control-label">Title<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" id="title" name="title" placeholder="Enter course name..."
                                                class="form-control" data-error="#errorAY" required>
                                            <span id="errorAY"></span>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    {{-- card-header --}}
                    <div class="card-header">
                        <h3 class="card-title">Courses List</h3>
                        {{-- <div class=" float-right">
                        <a href="{{ route('courseNames.create') }}" class="btn btn-success">
                            Add New Course</a>
                    </div> --}}
                    </div>
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (count($course_names) == 0)
                                <p>No record found</p>
                            @else
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Code</th>
                                            <th>Course Title</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($course_names as $course_name)

                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $course_name->code }}</td>
                                                <td>{{ $course_name->title }}</td>

                                                <td>
                                                    <div class="table-data-feature">
                                                        <form action="courseNames/{{ $course_name->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('courseNames.edit', [$course_name->id]) }}"
                                                                class="btn btn-primary">
                                                                <i class="zmdi zmdi-edit"></i>Edit
                                                            </a>
                                                            <!-- Delete functionality -->

                                                            <button type="submit" class="btn btn-danger delete-confirm"
                                                                data-name="{{ $course_name->title }}"
                                                                data-original-title="Delete">
                                                                Delete
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
            $(document).ready(function() {
                // form validation
                $("#regForm").validate({
                    rules: {
                        title: {
                            required: true,
                            maxlength: 90,
                            minlength: 2,
                        },
                        code: {
                            required: true,
                            maxlength: 4,
                            minlength: 2,
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
