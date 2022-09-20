@extends('layouts.admin')

@section('pageTitle')
    City Management
@endsection

@section('content')


    <div class="col-lg-12">
        {{-- Form --}}
        <form id="regForm" action="{{ route('cities.update', $city->id) }}" method="post" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-header">
                    <span class="card-title">City - Update</span>
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
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">City Name <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="text" id="city" name="city" value="{{ $city->city_name }}" placeholder="Enter city name" class="form-control"
                                        data-error="#errorAY">
                                    <span id="errorAY"></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-block">
                            Update
                        </button>
                    </div>
                </div>
            </div>

        </form>
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
