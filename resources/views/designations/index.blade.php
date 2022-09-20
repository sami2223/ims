@extends('layouts.admin')
@section('pageTitle')
    Designation Management
@endsection

@section('content')

    {{-- Form --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">New Designation</span>
                </div>
                <div class="card-body card-block">
                    <div>
                        <form id="regForm" action="{{ route('designations.store') }}" method="post" class="form-horizontal">
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
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Designation<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="designation" name="designation_name" placeholder="Enter designation name..." class="form-control"
                                        data-error="#errorAY">
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
                    <h3 class="card-title">Designations List</h3>
                    <div class=" float-right">
                        {{-- <a href="designations/create" class="btn btn-success">
                            Add New Designation</a> --}}
                    </div>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($designations) == 0)
                            <p>No record found</p>
                        @else
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Designation</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($designations as $designation)

                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $designation->designation_name }}
                                            </td>
                                            <td>


                                                <!-- Delete functionality -->
                                                <form action="designations/{{ $designation->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-primary"
                                                        href="designations/{{ $designation->id }}/edit">
                                                        <i class="zmdi zmdi-edit"></i>Edit
                                                    </a>
                                                    <button type="submit" class="btn btn-danger delete-confirm">
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
    </div>

    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    designation_name: {
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
