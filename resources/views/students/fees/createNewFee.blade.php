@extends('layouts.admin')

@section('pageTitle')
    Student Fee Management
@endsection

@section('content')




    {{-- Form --}}
    <div class="row">

        <div class="col-lg-12">
            <form id="regForm" action="/students/storeNewFee/{{ $slip->id }}" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Details</h3>
                        
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Slip No</label>
                                <input type="text" id="" name="slip_id" value="{{ $slip->id }}" class="form-control"
                                    disabled>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Student Reg.No.</label>
                                <input type="text" id="" name="student_id" value="{{ $slip->student->id }}" class="form-control"
                                    disabled>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Student Name</label>
                                <input type="text" id="" name="student_id"
                                    value="{{ $slip->student->first_name . ' ' . $slip->student->last_name }}" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div id="new_payment">
                            <div class="row form-group">
                                <div class="col-12 col-md-12">
                                    <label for="text-input" class=" form-control-label">Fee Type<span
                                            class="text-danger">*</span></label>
                                    <select name="fee_type" id="selectFeeType" class="form-control select2"
                                        data-error="#errorFeeType" required>
                                        <option value="">Please select</option>
                                        @foreach ($fee_types as $fee_type)
                                            <option value="{{ $fee_type->id }}">{{ $fee_type->fee_type }}</option>
                                        @endforeach
                                    </select>
                                    @error('fee_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span id="errorFeeType"></span>
                                </div>
            
                            </div>
                        </div>
                        
                        <div class="row form-group monthly">
                            <div class="col-12 col-md-6">
                                <label for="text-input" class=" form-control-label">Month</label>
                                <select name="selectMonth" id="" class="form-control select2" data-error="#errorMonth"
                                    required>
                                    <option value="">Please select</option>
                                    <option value="Jan">Jan</option>
                                    <option value="Feb">Feb</option>
                                    <option value="Mar">Mar</option>
                                    <option value="Apr">Apr</option>
                                    <option value="May">May</option>
                                    <option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option>
                                    <option value="Aug">Aug</option>
                                    <option value="Sep">Sep</option>
                                    <option value="Oct">Oct</option>
                                    <option value="Nov">Nov</option>
                                    <option value="Dec">Dec</option>
                                </select>
                                @error('selectMonth')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span id="errorMonth"></span>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="text-input" class=" form-control-label">Year</label>
                                <select name="selectYear" id="" class="form-control select2" data-error="#errorYear"
                                    required>
                                    <option value="">Please select</option>
                                    @for ($year = 2020; $year < 2100; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                <span id="errorYear"></span>
                                @error('selectYear')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Total Amount<span
                                        class="text-danger">*</span></label>
                                <input type="number" id="total1" name="total" class="form-control common"
                                    data-error="#errorTotal" required>
                                <span id="errorTotal"></span>
                                @error('total')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Paid Amount<span
                                        class="text-danger">*</span></label>
                                <input type="number" id="paid2" name="paid" class="form-control common"
                                    data-error="#errorPaid" required>
                                <span id="errorPaid"></span>
                                @error('paid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Balance</label>
                                <input type="number" id="balance3" name="balance" class="form-control" readonly>
                                <span id="errorBalance"></span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-block">
                             Save
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
                    fee_type: {
                        required: true,
                    },
                    total: {
                        required: true,
                        number: true,
                    },
                    paid: {
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

            $('.monthly').hide();
            $('#selectFeeType').change(function() {
                // fee type id
                var id = $(this).val();
                // alert($(this).find(":selected").text());
                var value = $(this).find(":selected").text();

                if (value == 'Monthly Fee') {
                    $('.monthly').show();
                } else {
                    $('.monthly').hide();
                }

                $.ajax({
                    url: '/getFeetypeFee/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response['data']);
                        var len = 0;
                        if (response['data'] != null) {
                            if(response['data'][0].course_id == {{ $slip->student->session_id }}){
                                // console.log('sessioiooo');
                                $('#total1').val(response['data'][0].amount);
                            }
                        }
                    }
                });
            });

            $('.common').change(function() {
                $('#balance3').val(parseFloat("0" + $('#total1').val()) - parseFloat("0" + $('#paid2')
                .val()));
            });

            
        });
    </script>

@endsection
