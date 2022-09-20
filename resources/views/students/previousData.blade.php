@extends('layouts.admin')

@section('pageTitle')
    Add Student Previous Data
@endsection

@section('content')    

{{-- Content Header --}}
<section>
    <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
        <div class="float-left">
            <h4>Studen Previous Data - Create</h4>
        </div>

        <div class="float-right">
            <a class="btn btn-success mx-1" href="/students/{{ $student->id }}">View Profile</a>
        </div>
    </div>
</section>
{{-- End Content Header --}}


    {{-- Form --}}
    <div class="mt-4 d-flex justify-content-center">
        
        <div class="col-lg-8">
            {{-- display success message --}}
        @if (session('successMsg'))
        
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                {{-- <span class="badge badge-pill badge-primary">Success</span> --}}
                <strong>{{ session('successMsg') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        
    @endif

            <form id="regForm" action="/students/storePreviousData/{{ $student->id }}" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <strong>Previous Educational Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Education<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="education" name="education" placeholder="" class="form-control" data-erroe="#errorEducation">
                                <span id="errorEducation"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Computer Knowledge<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="computer_knowledge" name="computer_knowledge" placeholder="" class="form-control" data-erroe="#errorCourse">
                                <span id="errorCourse"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <a href="{{ URL('students/'. $student->id) }}" class="btn btn-success btn-sm">
                            <i class="zmdi zmdi-skip-next"></i> Skip
                        </a>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="zmdi zmdi-save"></i> Save and proceed
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
                    institution: {
                        required: true,
                        maxlength: 90,
                    },
                    course: {
                        required: true,
                        maxlength: 50,
                    },
                    year: {
                        required: true,
                        number: true,
                    },
                    totalMarks: {
                        required: true,
                        number: true,
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