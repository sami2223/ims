@extends('layouts.admin')

@section('pageTitle')
    Fee Management
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Fee Amount</h3>
                    <div class="float-right">

                    </div>
                </div>

                <div class="card-body">
                    <div class="">
                        <div class="col-12">
                            <form id="regForm" action="{{ route('feetypes.updateaddfee', $addFee->id) }}" method="post"
                                class="form-horizontal">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <div id="courseD" class="row">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Course<label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="selectCourse" id="selectCourse" class="form-control select2"
                                                disabled>
                                                <option value="" selected>{{ $addFee->Course->coursename->title }}</option>
                                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div id="" class="row">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Session</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="selectSession" id="session" class="form-control select2"
                                                disabled>
                                                <option value="" selected>{{ $addFee->Course->course }}</option>

                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Fee Type</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="selectFeetype" id="selectFeetype" class="form-control select2"
                                                disabled>
                                                <option value="" selected>{{ $addFee->Feetype->fee_type }}</option>
                                                
                                            </select>
                                            <span id="errorA2"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Amount<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="number" maxlength="8" name="amount" class="form-control" value="{{ $addFee->amount }}" data-error="#errorA33"
                                                required>
                                            <span id="errorA33"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div id="shiftD" class="row">
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

    </div>



    <script>

        $(document).ready(function() {

            // form validation
            $("#regForm").validate({
                rules: {
                    
                    amount: {
                        required: true,
                        maxlength: 8,
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
