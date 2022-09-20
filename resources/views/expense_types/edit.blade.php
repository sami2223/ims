@extends('layouts.admin')

@section('pageTitle')
Expense Types Management
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        {{-- Form --}}
        <form id="regForm" action="{{ route('expense_types.update', $expenseType->id) }}" method="post" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Expense Types - Edit</span>
                </div>
                <div class="card-body card-block">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-8">
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
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Expense Type<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-7">
                                    <input type="text" id="expense_type" name="expense_type" value="{{ $expenseType->expense_type }}" placeholder="" class="form-control"
                                        data-error="#errorAY" required>
                                    <span id="errorAY"></span>

                                </div>
                                <div class="col-12 col-md-2">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="zmdi zmdi-save"></i> Update
                                        </button>
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
                expense_type: {
                    required: true,
                    maxlength: 50,
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
