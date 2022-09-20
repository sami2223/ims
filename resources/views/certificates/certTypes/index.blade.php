@extends('layouts.admin')
@section('pageTitle')
    Certificate Type Management
@endsection

@section('content')

    <div class="row">


        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <span class="card-title">New Certificate Type</span>
                </div>
                <div class="card-body card-block">
                    <div>
                        <form id="regForm" action="/certTypes" method="post" class="form-horizontal">
                            @csrf
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
                                        <label for="text-input" class=" form-control-label">Certificate Type<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="certType" name="certType" value="{{ old('certType') }}"
                                            placeholder="Enter certificate name..." class="form-control"
                                            data-error="#errorAY" required>
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
                    <h3 class="card-title">Certificate Types - List</h3>
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
                                    <th>Certificate Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($certTypes as $certType)

                                    <tr class="tr-shadow">
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            {{ $certType->cert_type }}
                                        </td>

                                        <td>
                                            <div class="table-data-feature">
                                                <form action="{{ route('certTypes.destroy', $certType->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <!-- Edit functionality -->
                                                    <a href="{{ route('certTypes.edit', [$certType->id]) }}"
                                                        class="btn btn-primary">
                                                        Edit
                                                    </a>
                                                    <!-- Delete functionality -->

                                                    <button type="submit" class="btn btn-danger delete-confirm"
                                                        data-name="{{ $certType->cert_type }}"
                                                        data-original-title="Delete">
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

    <div class="row">

    </div>



    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {
                    certType: {
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
