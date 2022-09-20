@extends('layouts.admin')

@section('pageTitle')
    Education Management
@endsection

@section('content')


    <div class="col-lg-12">
        {{-- Form --}}
        <form id="regForm" action="/education" method="post" class="form-horizontal">
            @csrf
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Education - New</span>
                </div>
                <div class="card-body card-block">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-6">
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
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">Education <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="text" id="education" name="education" value="{{ old('education') }}" placeholder="Enter education" class="form-control"
                                        data-error="#errorAY">
                                    <span id="errorAY"></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="zmdi zmdi-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>


    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    education: {
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
