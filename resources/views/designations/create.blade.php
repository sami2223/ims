@extends('layouts.admin')

@section('pageTitle')
Designation Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Designation - New</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a href="{{ route('designations.index') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}} 
    

    {{-- Form --}}
    <div class="mt-4 d-flex justify-content-center">
        
        <div class="col-lg-6">
            <form id="regForm" action="/designations" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <strong>Designation Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Designation<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="designation" name="designation_name" placeholder="" class="form-control" data-error="#errorAY">
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