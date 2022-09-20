@extends('layouts.admin')
@section('pageTitle')
    Salaries Management
@endsection

@section('content')

    <div class="row">
        {{-- Form --}}
        <div class="col-md-4">
            <form id="regForm" action="{{ route('salaries.update', $salary->id) }}" method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Salary - Edit</span>
                    </div>
                    <div class="card-body card-block">
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
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Employee Name<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                @php
                                    $employees = App\Models\Employee::all();
                                @endphp
                                <select name="selectEmployee" id="selectEmployee" class="form-control select2"
                                    data-error="#errorAY" disabled>
                                    <option value="">Please select</option>
                                    @foreach ($employees as $employee)
                                        @if($employee->id == $salary->Employee->id)
                                        <option value="{{ $employee->id }}" selected>{{ $employee->employee_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                    @endforeach
                                </select>
                                <span id="errorAY"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Salary Type</label>
                            </div>
                            <div class="col-12">
                                <select name="salType" id="salType" class="form-control select2" disabled>
                                    <option value="">Please select</option>
                                    @if($salary->Employee->sal_type == 'Monthly')
                                    <option value="Monthly" selected>Monthly</option>
                                    <option value="Classwise">Classwise</option>
                                    @elseif($salary->Employee->sal_type == 'Classwise')
                                    <option value="Monthly">Monthly</option>
                                    <option value="Classwise" selected>Classwise</option>   
                                    @endif
                                </select>
                            </div>
                        </div>

                        @if($salary->Employee->sal_type == 'Classwise')
                        <div id="" class="form-group">
                            {{-- for classwise salary --}}
                            <div  class="d-flex">
                                <div class="col-md-6 mb-1">
                                    <div>
                                        <label for="text-input" class=" form-control-label">No. of Classes<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div>
                                        <input type="text" id="classes" name="classes" value="{{ $salary->no_of_classes }}"
                                            placeholder="" class="form-control" data-error="#errorAXc" required>
                                        <span id="errorAXc"></span>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div>
                                        <label for="text-input" class=" form-control-label">Charges/Class<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div>
                                        <input type="text" id="charges" name="charges" value="{{ $salary->Employee->sal_amount }}"
                                            placeholder="" class="form-control" data-error="#errorAXd">
                                        <span id="errorAXd"></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($salary->Employee->sal_type == 'Monthly')
                        <div id="" class="form-group">
                            {{-- for monthly salary --}}
                            <div class="d-flex">
                                
                                <div class="col-md-6 mb-1">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Salary Month<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div>
                                        <select name="month" id="month" class="form-control select2" data-error="#salmonth"
                                            required>
                                            <option value="">Month</option>
                                            <option value="Jan">Jan (01)</option>
                                            <option value="Feb">Feb (02)</option>
                                            <option value="Mar">Mar (03)</option>
                                            <option value="Apr">Apr (04)</option>
                                            <option value="May">May (05)</option>
                                            <option value="Jun">Jun (06)</option>
                                            <option value="Jul">Jul (07)</option>
                                            <option value="Aug">Aug (08)</option>
                                            <option value="Sep">Sep (09)</option>
                                            <option value="Oct">Oct (10)</option>
                                            <option value="Nov">Nov (11)</option>
                                            <option value="Dec">Dec (12)</option>
                                        </select>
                                        <span id="salmonth"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Year<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div>
                                        <select name="year" id="year" class="form-control select2" data-error="#yr"
                                            required>
                                            <option value="">Year</option>
                                            @for ($i = 2021; $i <= 2099; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <span id="yr"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif                       

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Salary Amount<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                <input type="text" id="amount" name="amount" value="{{ $salary->Employee->sal_amount }}"
                                    class="form-control" data-error="#errorAX">
                                <span id="errorAX"></span>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Security</label>
                            </div>
                            <div class="col-12">
                                <input type="text" id="security" name="security" value="{{  $salary->security  }}"
                                    placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Net Salary</label>
                            </div>
                            <div class="col-12">
                                <input type="text" id="netSalary" name="netSalary" value="{{  $salary->net_salary  }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class=" form-control-label">Advance</label>
                            </div>
                            <div class="col-12">
                                <select name="advance" id="advance" class="form-control select2">
                                    @if($salary->advance)
                                    <option value="0">No</option>
                                    <option value="1" selected>Yes</option>
                                    @else
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                    @endif
                                    
                                </select>
                            </div>
                        </div>

                        @php
                            $day = date('d', strtotime($salary->sal_date));
                            $month = date('m', strtotime($salary->sal_date));
                            $year = date('Y', strtotime($salary->sal_date));
                        @endphp
                        <div class="form-group">
                            <div class="col">
                                <label for="text-input" class="form-control-label">Payment Date</label>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectDay" id="selectDay" class="form-control select2"
                                            data-error="#d" required>
                                            <option value="{{ $day }}">{{ $day }}</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span id="d"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectMonth" id="selectMonth" class="form-control select2"
                                            data-error="#m" required>
                                            <option value="{{ $month }}">{{ $month }}</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span id="m"></span>
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <select name="selectYear" id="selectYear" class="form-control select2"
                                            data-error="#y" required>
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @for ($i = 2021; $i <= 2099; $i++)
                                                @if ($i < 10) <?php $i = '0' . $i; ?> @endif <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <span id="y"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Update
                                {{-- <i class="ml-2 fas fa-arrow-right"></i> --}}
                            </button>
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
                    amount: {
                        required: true,
                        maxlength: 8,
                        // digits: true,
                    },
                    message: {
                        required: 'This field is required'
                    }

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

            $('#classes').change(function() {
                $('#amount').val(parseFloat("0" + $('#classes').val()) * parseFloat("0" + $('#charges')
                .val()));

                $('#netSalary').val($('#amount').val());
            });

            $('#security').change(function() {
                $('#netSalary').val(parseFloat("0" + $('#amount').val()) - parseFloat("0" + $('#security')
                .val()));
            });
        });
    </script>

@endsection
