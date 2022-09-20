@extends('layouts.admin')
@section('pageTitle')
    Staff Management
@endsection

@php
$designations = App\Models\Designation::all();
@endphp

@section('content')

    {{-- Form --}}
    <div class="row">

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <span class="card-title">New Employee</span>
                </div>
                <div class="card-body">
                    <div>
                        <form id="regForm" action="{{ route('employees.store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class="form-control-label">Employee Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="employee_name" name="employee_name" placeholder=""
                                            class="form-control" data-error="#errorB">
                                        <span id="errorB"></span>
    
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Email<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="email" name="email" placeholder="" class="form-control"
                                            data-error="#errorC">
                                        <span id="errorC"></span>
    
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Designation<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <select name="designation" id="designation" class="form-control select2"
                                            data-error="#errorAY">
                                            <option value="">Please select</option>
                                            @foreach ($designations as $designation)
                                                <option value="{{ $designation->id }}">{{ $designation->designation_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="errorAY"></span>
    
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Salary Type<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <select id="sal_type" name="sal_type" class="form-control select2" data-error="#errorBs"
                                            required>
                                            <option value="Monthly" selected>Monthly</option>
                                            <option value="Classwise">Class-wise</option>
                                        </select>
                                        <span id="errorBs"></span>
    
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Salary Amount<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="sal_amount" name="sal_amount" placeholder=""
                                            class="form-control" data-error="#errorBd" required>
                                        <span id="errorBd"></span>
    
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
                    <h3 class="card-title">Employees List</h3>
                    <div class=" float-right">

                    </div>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($employees) == 0)
                            <p> No record found</p>
                        @else
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Designation</th>
                                        <th>Salary Type</th>
                                        <th>Salary</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($employees as $employee)

                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $employee->employee_name }}
                                            </td>
                                            <td>
                                                {{ $employee->email }}
                                            </td>
                                            <td>
                                                {{ $employee->Designation->designation_name }}
                                            </td>
                                            <td>{{ $employee->sal_type }}</td>
                                            <td>{{ $employee->sal_amount }}</td>
                                            <td>
                                                <form action="employees/{{ $employee->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="employees/{{ $employee->id }}/edit"
                                                        class="btn btn-primary mb-1">
                                                        <i class="zmdi zmdi-edit"></i>Edit
                                                    </a>
                                                    <!-- Delete functionality -->

                                                    <button type="submit" class="btn btn-danger mb-1 delete-confirm"
                                                        data-name="{{ $employee->employee_name }}">
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



    <div class="row">

    </div>

    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    employee_name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    designation: {
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
