@extends('layouts.admin')

@section('pageTitle')
    Designation Management
@endsection

@section('content')

    {{-- Form --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Edit Designation</span>
                    <div class=" float-right">
                        <a class="btn btn-success" href="{{ route('designations.index') }}">Back</a>
                    </div>
                </div>
                <div class="card-body card-block">
                    <div>
                        <form id="regForm" action="{{ route('designations.update', $designation->id) }}" method="post" class="form-horizontal">
                            @csrf
                            @method('put')
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
                                        <label for="text-input" class=" form-control-label">Designation<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="designation" name="designation_name"
                                            value="{{ $designation->designation_name }}" class="form-control"
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
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
