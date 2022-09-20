@extends('layouts.admin')

@section('pageTitle')
Exam Types Management
@endsection

@section('content')
    

    {{-- Form --}}
    <div class="row">
        
        <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="regForm" action="/examTypes" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Exam Type Details</span>
                    </div>
                    <div class="card-body card-block">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Exam Type<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <input type="text" id="examType" name="type" placeholder="" class="form-control" data-error="#errorAY">
                                        <span id="errorAY"></span>
                                        
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="zmdi zmdi-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        
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
                    type: {
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