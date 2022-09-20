@extends('layouts.admin')
@section('pageTitle')
    Shift Management
@endsection

@section('content')

    {{-- Form --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">New Shift</span>
                </div>
                <div class="card-body card-block">
                    <div>
                        <form id="regForm" action="/shifts" method="post" class="form-horizontal">
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
                                        <label for="text-input" class=" form-control-label">Shift Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="shift" name="shift_name" placeholder="Enter shift name..." class="form-control"
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
                    <h3 class="card-title">Shifts Details</h3>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($shifts) == 0)
                            <p>No record found</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Shifts</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($shifts as $shift)

                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $shift->shift_name }}
                                            </td>
                                            <td>

                                                <form action="shifts/{{ $shift->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="shifts/{{ $shift->id }}/edit" class="btn btn-primary">
                                                        <i class="zmdi zmdi-edit"></i>Edit
                                                    </a>
                                                    <!-- Delete functionality -->

                                                    <button type="submit" class="btn btn-danger delete-confirm"
                                                        data-name="{{ $shift->shift_name }}">
                                                        <i class="zmdi zmdi-delete"></i>Delete
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
                    shift_name: {
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
