@extends('layouts.admin')

@section('pageTitle')
    Certificates Management
@endsection

@php
    $certTypes = App\Models\CertType::all();
@endphp

@section('content')

<div class="row">
    <div class="col-md-12">
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
        <form id="regForm" action="{{ route('certificates.saveIssue', $student->id) }}" method="POST" class="form-horizontal">
            @csrf
            
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Issue Certificate to <strong>{{ $student->first_name }}</strong>, having <strong>Reg.No. {{ $student->reg_no }}</strong></h3>
                    </div>
                
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-8">
                           
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class="form-control-label">Certificate Type : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="selectType" id="selectType" class="form-control select2" data-error="#type">
                                        <option value="">Please select</option>
                                        @foreach ($certTypes as $certType)
                                        <option value="{{ $certType->id }}">{{ $certType->cert_type }}</option>
                                        @endforeach
                                    </select>
                                    <span id="type"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Received Date : </label>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectDay" id="selectDay" class="form-control select2" data-error="#d">
                                        <option value="">Day</option>
                                        @for ($i=1; $i<=31; $i++)
                                        @if($i<10)
                                            <?php  
                                                $i = '0' . $i;
                                            ?>
                                        @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span id="d"></span>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectMonth" id="selectMonth" class="form-control select2" data-error="#m">
                                        <option value="">Month</option>
                                        @for ($i=1; $i<=12; $i++)
                                        @if($i<10)
                                            <?php  
                                                $i = '0' . $i;
                                            ?>
                                        @endif
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span id="m"></span>
                                </div>
                                <div class="col-12 col-md-3 mb-1">
                                    <select name="selectYear" id="selectYear" class="form-control select2" data-error="#y">
                                        <option value="">Year</option>
                                        @for ($i=2021; $i<=2099; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span id="y"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Received by : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="received_by" class="form-control" data-error="#rec">
                                    <span id="rec"></span>
                                </div>
                            </div>                           
                            
                        </div>
                        
                    </div>
                    
                    
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="zmdi zmdi-save"></i> Receive
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
                
                selectType: {
                    required: true,
                },
                selectDay: {
                    required: true,
                },
                selectMonth: {
                    required: true,
                },
                selectYear: {
                    required: true,
                },
                received_by: {
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
