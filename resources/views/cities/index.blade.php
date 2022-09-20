@extends('layouts.admin')
@section('pageTitle')
    City Management
@endsection

@section('content')

    <div class="col-lg-12">
        {{-- Form --}}
        <form id="regForm" action="{{ route('cities.store') }}" method="post" class="form-horizontal">
            @csrf
            <div class="card">
                <div class="card-header">
                    <span class="card-title">City - New</span>
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
                                    <label for="text-input" class=" form-control-label">City Name <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-7">
                                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                                        placeholder="Enter city name" class="form-control" data-error="#errorAY">
                                    <span id="errorAY"></span>

                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success btn-block form-control">
                                        <i class="zmdi zmdi-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    
                </div>
            </div>

        </form>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- card-header --}}
                <div class="card-header">
                    <h3 class="card-title">City - List</h3>

                </div>
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($cities) == 0)
                            <p>No record found</p>
                        @else
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>City</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($cities as $city)

                                        <tr class="tr-shadow">
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $city->city_name }}
                                            </td>

                                            <td>
                                                <div class="table-data-feature">
                                                    <form action="{{ route('cities.destroy', $city->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <!-- Edit functionality -->
                                                        <a href="{{ route('cities.edit', [$city->id]) }}"
                                                            class="btn btn-success">
                                                            <i class="zmdi zmdi-edit"></i>Edit
                                                        </a>
                                                        <!-- Delete functionality -->

                                                        <button type="submit" class="btn btn-danger delete-confirm"
                                                            data-name="{{ $city->city_name }}"
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
                    city: {
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
