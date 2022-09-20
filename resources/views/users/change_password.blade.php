@extends('layouts.student')
@section('pageTitle')
    Change Password
@endsection

@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
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
            <form id="regForm" action="{{ route('users.updatePassword', [$user->id]) }}" method="post"
                class="form-horizontal" onsubmit="return verifyPassword()">
                @csrf
                @method('put')
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3> 
                            
                        <div class="float-right">
                            {{-- @if(auth()->user()->is_admin == 0)
                            <a class="btn btn-primary" href="{{ route('std_dashboard', [$student->id]) }}">
                                <i class="fas fa-arrow-left"></i>
                                Back
                            </a>
                            @endif --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Password<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="password" id="password" name="password" placeholder=""
                                    class="form-control" data-error="#errorAY">
                                <span id="errorAY"></span>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">New Password<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="password" id="new_password" name="new_password" placeholder=""
                                    class="form-control" data-error="#errorNP">
                                <span id="errorNP" class="text-danger"></span>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Confirm Password<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="password" id="confirm_password" name="confirm_password" placeholder=""
                                    class="form-control" data-error="#errorCP">
                                <span id="errorCP"></span>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">
                            Change Password
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // form validation
        $("#regForm").validate({
            rules: {

                password: {
                    required: true,
                    maxlength: 20,
                },
                new_password: {
                    required: true,
                    maxlength: 20,
                    min: 8,
                },
                confirm_password: {
                    required: true,
                    maxlength: 20,
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

    // function verifyPassword() {
    //     var pw = document.getElementById("new_password").value;
    //     //check empty password field  
    //     // if (pw == "") {
    //     //     document.getElementById("errorNP").innerHTML = "**Fill the password please!";
    //     //     return false;
    //     // }

    //     //minimum password length validation  
    //     if (pw.length < 8) {
    //         document.getElementById("errorNP").innerHTML = "Password length must be atleast 8 characters";
    //         return false;
    //     }

    //     //maximum length of password validation  
    //     if (pw.length > 20) {
    //         document.getElementById("errorNP").innerHTML = "Password length must not exceed 20 characters";
    //         return false;
    //     } else {
    //         alert("Password is correct");
    //     }
    // }
</script>
@endsection

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IMS - Change Password</title>
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
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
                <form id="regForm" action="{{ route('users.updatePassword', [$user->id]) }}" method="post"
                    class="form-horizontal" onsubmit="return verifyPassword()">
                    @csrf
                    @method('put')
                    <div class="card">

                        <div class="card-header">
                            Change Password
                        </div>

                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">Password<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="password" id="password" name="password" placeholder=""
                                        class="form-control" data-error="#errorAY">
                                    <span id="errorAY"></span>

                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">New Password<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="password" id="new_password" name="new_password" placeholder=""
                                        class="form-control" data-error="#errorNP">
                                    <span id="errorNP" class="text-danger"></span>

                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="text-input" class=" form-control-label">Confirm Password<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder=""
                                        class="form-control" data-error="#errorCP">
                                    <span id="errorCP"></span>

                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">
                                Change Password
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // form validation
            $("#regForm").validate({
                rules: {

                    password: {
                        required: true,
                        maxlength: 20,
                    },
                    new_password: {
                        required: true,
                        maxlength: 20,
                        min: 8,
                    },
                    confirm_password: {
                        required: true,
                        maxlength: 20,
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

        function verifyPassword() {
            // var pw = document.getElementById("new_password").value;
            // //check empty password field  
            // // if (pw == "") {
            // //     document.getElementById("errorNP").innerHTML = "**Fill the password please!";
            // //     return false;
            // // }

            // //minimum password length validation  
            // if (pw.length < 8) {
            //     document.getElementById("errorNP").innerHTML = "Password length must be atleast 8 characters";
            //     return false;
            // }

            // //maximum length of password validation  
            // if (pw.length > 20) {
            //     document.getElementById("errorNP").innerHTML = "Password length must not exceed 20 characters";
            //     return false;
            // } else {
            //     alert("Password is correct");
            // }
        }
    </script>
</body>

</html> --}}
