@extends('layouts.admin')
@section('pageTitle')
    Expense Types Management
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            {{-- Form --}}
            <form id="regForm" action="{{ route('expense_types.store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Expense Types - New</span>
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
                                <label for="text-input" class=" form-control-label">Expense Type<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12">
                                <input type="text" id="expense_type" name="expense_type" value="{{ old('expense_type') }}"
                                    placeholder="" class="form-control" data-error="#errorAY"
                                    required>
                                <span id="errorAY"></span>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Save
                            </button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
        <div class="col-md-8">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">Expense Types - List</h3>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- @if (count($certTypes) == 0)
                        <p>No record found</p>
                    @else --}}
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Expense Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($expenseTypes as $expenseType)

                                    <tr class="tr-shadow">
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            {{ $expenseType->expense_type }}
                                        </td>

                                        <td>
                                            <div class="___class_+?22___">
                                                <form action="{{ route('expense_types.destroy', $expenseType->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <!-- Edit functionality -->
                                                    <a href="{{ route('expense_types.edit', [$expenseType->id]) }}"
                                                        class="btn btn-success">
                                                        <i class="zmdi zmdi-edit"></i>Edit
                                                    </a>
                                                    <!-- Delete functionality -->

                                                    <button type="submit" class="btn btn-danger delete-confirm">
                                                        Delete
                                                    </button>
                                                </form>
                                                <!-- Delete functionality End -->
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @endif --}}
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
