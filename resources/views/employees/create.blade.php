@extends('layouts.admin')

@section('pageTitle')
    Staff Management
@endsection

@section('content')



    {{-- Form --}}
    <div class="mt-4 d-flex justify-content-center">
        
        <div class="col-lg-6">
            <form id="regForm" action="/employees" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Staff - New</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="employee_name" name="employee_name" placeholder="" class="form-control" data-error="#errorB">
                                <span id="errorB"></span>
                                
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Email<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="email" name="email" placeholder="" class="form-control" data-error="#errorC">
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
                                        <option value="">Please select</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                        @endforeach
                                    </select>
                                <span id="errorAY"></span>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="zmdi zmdi-save"></i> Save
                        </button>
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
                        email:true,
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