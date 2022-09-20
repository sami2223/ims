@extends('layouts.admin')

@section('pageTitle')
    Shift Management
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
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
            <form id="regForm" action="{{ route('shifts.update', $shift->id) }}" method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Shift - Edit</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="d-flex justify-content-center">
                            <div class="col">
                                <div class="row form-group">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Shift Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="shift" name="shift_name" value="{{ $shift->shift_name }}"
                                            class="form-control" data-error="#errorAY">
                                        <span id="errorAY"></span>

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
                            </div>
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
                    shift_name: {
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
