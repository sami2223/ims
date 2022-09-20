@extends('layouts.admin')

@section('pageTitle')
Exam Types Management
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="mb-4 d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Exam Types - Edit</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <a href="{{ route('examTypes.index') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </section>
    {{-- End Content Header --}} 
    

    {{-- Form --}}
    <div class=" d-flex justify-content-center">
        
        <div class="col-lg-6">
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
            <form id="regForm" action="/examTypes/{{ $examType->id }}" method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header">
                        <strong>Exam Type Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Exam Type<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="type" name="type" value="{{ $examType->type }}" class="form-control" data-error="#errorAY">
                                <span id="errorAY"></span>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="zmdi zmdi-save"></i> Update
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