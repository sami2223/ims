@extends('layouts.admin')
@section('pageTitle')
    Fee Types Management
@endsection

@section('content')

    <div class="row">

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <span class="card-title">New Fee Type</span>
                </div>
                <div class="card-body card-block">
                    <div>
                        <form id="regForm" action="/fee_types" method="post" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Fee Type<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="text" id="fee_type" name="fee_type" placeholder="" class="form-control"
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
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>


        </div>

        <div class="col-md-8">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">Fee Types List</h3>

                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($fee_types) == 0)
                            <p>No record found</p>
                        @else
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Fee Types</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($fee_types as $fee_type)

                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $fee_type->fee_type }}
                                            </td>
                                            <td>

                                                <form action="fee_types/{{ $fee_type->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="fee_types/{{ $fee_type->id }}/edit" class="btn btn-success">
                                                        Edit
                                                    </a>
                                                    <!-- Delete functionality -->

                                                    <button type="submit" class="btn btn-danger delete-confirm">
                                                        Delete
                                                    </button>
                                                </form>
                                                <!-- Delete functionality End -->

                                            </td>

                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        @endif
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
