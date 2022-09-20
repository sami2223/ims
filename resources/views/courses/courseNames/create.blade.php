@extends('layouts.admin')

@section('pageTitle')
    Courses Management
@endsection

@section('content')
  

    {{-- Form --}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- card-header --}}
                    <div class="card-header">
                        <h3 class="card-title">Course - New</h3>
                        <div class=" float-right">
                            <a class="btn btn-success" href="{{ route('courseNames.index') }}">Back</a>

                        </div>
                    </div>
                    <!-- card-body -->
                    <div class="card-body d-flex justify-content-center">
                        <div class="col-lg-8">
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
                            <form id="regForm" action="{{ route('courseNames.store') }}" method="POST" class="form-horizontal">
                                @csrf
                                {{-- Course Details --}}
                                <div class="card">
                                    
                                    <div class="card-body">
                
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Course Name<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="title" name="title" placeholder="" class="form-control" data-error="#errorCourse">
                                                <span id="errorCourse"></span>
                                            </div>
                                        </div> 
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Description</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                                {{-- <input type="textarea" id="description" name="description" placeholder="" class="form-control"> --}}
                                            </div>
                                        </div> 
                
                                    </div>
                                    <div class="card-footer d-flex justify-content-center">
                                        <button type="submit" class="btn btn-block btn-success">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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