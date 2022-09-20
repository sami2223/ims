@extends('layouts.admin')

@section('pageTitle')
    Employees Management
@endsection

@section('content')

    {{-- Form --}}
    <div class="row">
        
        <div class="col-md-12">
            <form id="regForm" action="/employees/{{ $employee->id }}" method="post" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Employee - Edit</span>
                    </div>
                    <div class="card-body card-block">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Name<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="text" id="employee_name" name="employee_name" value="{{ $employee->employee_name }}" class="form-control" data-error="#errorA">
                                        <span id="errorA"></span>
                                        
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Email<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="text" id="email" name="email" value="{{ $employee->email }}" class="form-control" data-error="#errorC">
                                        <span id="errorC"></span>
                                        
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Designation<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="designation" id="designation" class="form-control select2"
                                                data-error="#errorAY">
                                                
                                                @foreach ($designations as $designation)
                                                @if ($employee->designation_id == $designation->id)
                                                <option value="{{ $designation->id }}" select>{{ $designation->designation_name }}</option>
                                                @continue
                                                @endif
                                                    <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                @endforeach
                                            </select>
                                        <span id="errorAY"></span>
                                        
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Salary Type<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select id="sal_type" name="sal_type" value="{{ $employee->sal_type }}" class="form-control select2" data-error="#errorAc" required>
                                            @if($employee->sal_type == 'Monthly')
                                                <option value="Monthly" selected>Monthly</option>
                                                <option value="Classwise">Class-wise</option>
                                            @else
                                                <option value="Monthly">Monthly</option>
                                                <option value="Classwise" selected>Class-wise</option> 
                                            @endif
                                        </select>
                                        <span id="errorAc"></span>
                                        
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Salary<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="text" id="sal_amount" name="sal_amount" value="{{ $employee->sal_amount }}" class="form-control" data-error="#errorAb" required>
                                        <span id="errorAb"></span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="zmdi zmdi-save"></i> Update
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
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