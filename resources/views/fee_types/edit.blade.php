@extends('layouts.admin')

@section('pageTitle')
Fee Type Management
@endsection

@section('content')

<div class="col-md-4">

    <div class="card">
        <div class="card-header">
            <span class="card-title">Edit Fee Type</span>
        </div>
        <div class="card-body card-block">
            <div>
                <form id="regForm" action="{{ route('fee_types.update', $fee_type->id) }}" method="post" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <div class="row">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Fee Type<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="fee_type" name="fee_type" value="{{ $fee_type->fee_type }}" class="form-control"
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


    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    fee_type: {
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