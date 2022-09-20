@extends('layouts.app')

@section('pageTitle')
    Categories
@endsection

@section('content')

    {{-- Content Header --}}
    <section>
        <div class="container d-flex align-items-center justify-content-between p-t-30 p-b-30" style="border-bottom: 1px solid rgb(184, 179, 179)">
            <div class="">
                <h4>Categories - Edit</h4>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                
            </div>
        </div>
    </section>
    {{-- End Content Header --}}   
    
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="{{ URL('/') }}">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item active">
                                    <a href="{{ URL('/categories') }}">Categories</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>></span>
                                </li>
                                <li class="list-inline-item">
                                    Edit
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->



    {{-- Form --}}
    <div class="container-fluid d-flex justify-content-center">
        
        <div class="col-lg-6">
            <form id="regForm" action="/categories/{{ $category->id }}" method="post" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <strong>Category Details</strong>
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Category Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="title" name="title" value="{{ $category->title }}" class="form-control" data-error="#error">
                                <span id="error"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Description</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="cat_description" name="description" value="{{ $category->description }}" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="zmdi zmdi-save"></i> Update
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
                    title: {
                        required: true,
                        maxlength: 50,
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