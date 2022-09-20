@extends('layouts.admin')
@section('pageTitle')
    Expenses Management
@endsection

@section('content')

    <div class="row">
        {{-- Form --}}
        <div class="col-md-12">
            <form id="regForm" action="{{ route('expenses.update', $expense->id) }}" method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Expenses - Edit</span>
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
                                <div class="form-group">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Expense Type<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        @php
                                            $expTypes = App\Models\ExpenseType::all();
                                        @endphp
                                        <select name="selectExpType" id="ExpType" class="form-control select2"
                                            data-error="#errorAY" required>
                                            <option value="">Please select</option>
                                            @foreach ($expTypes as $exptype)
                                                @if ($expense->expense_type_id == $exptype->id)
                                                    <option value="{{ $exptype->id }}" selected>
                                                        {{ $exptype->expense_type }}</option>
                                                    @continue
                                                @endif
                                                <option value="{{ $exptype->id }}">{{ $exptype->expense_type }}</option>
                                            @endforeach
                                        </select>
                                        <span id="errorAY"></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="text-input" class=" form-control-label">Amount<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="amount" name="amount" value="{{ $expense->amount }}"
                                            class="form-control" data-error="#errorAX" required>
                                        <span id="errorAX"></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col">
                                        <label for="text-input" class="form-control-label">Date<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            @php
                                                $day = date('d', strtotime($expense->dated));
                                                $month = date('m', strtotime($expense->dated));
                                                $year = date('Y', strtotime($expense->dated));
                                            @endphp
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
                                                    @for ($i = 1990; $i <= 2050; $i++)
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
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-block">
                                Save
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
        });
    </script>

@endsection
