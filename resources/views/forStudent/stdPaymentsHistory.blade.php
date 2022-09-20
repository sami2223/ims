@extends('layouts.student')
@section('pageTitle')
    Student Payment History
@endsection

@php 
    $totalAmount = 0; 
    $paidAmount = 0;
    // $totalBalance = 0;
@endphp

@section('content')

<div class="container mt-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payments History of <strong>{{ $student->first_name }}</strong> having 
                        <strong>Reg. No. {{ $student->id }}</strong>, Enrolled in 
                        @if(!empty($student->Course))
                        <strong>Course {{ $student->Course->course }}</strong>  </h3> 
                        @else
                        <strong>Course </strong> (missing)</h3> 
                        @endif
                    <div class="float-right">
                        
                        <a class="btn btn-primary" href="{{ route('std_dashboard', [$student->id]) }}">
                            <i class="fas fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if (count($student->Fees) == 0)
                        <p> No record found</p>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Slip No.</th>
                                        <th>Payment Date</th>
                                        <th>Fee Type</th>
                                        <th>Due Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Balance</th>
                                        <th>Month</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                    @foreach ($student->Fees as $fee)
            
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {{ $fee->FeeSlip->id }}
                                            </td>
                                            <td>
                                                {{ $fee->created_at }}
                                            </td>
                                            <td>
                                                {{ $fee->fee_type }}
                                            </td>
                                            <td>
                                                {{ $fee->total_amount }}
                                                @php
                                                if(!empty($fee->paid_amount)){
                                                    $totalAmount += $fee->total_amount;
                                                }
                                                    
                                                @endphp
                                            </td>
                                            <td>
                                                {{ $fee->paid_amount }}
                                                @php
                                                if(!empty($fee->paid_amount)){
                                                    $paidAmount += $fee->paid_amount;
                                                }
                                                @endphp
                                            </td>
                                            <td>
                                                {{ $fee->balance }}
                                            </td>
                                            <td>
                                                {{ $fee->for_month . '-'.  $fee->for_year }}
                                            </td>
            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        
                    @endif

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    @if (count($student->Fees) != 0)    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Payments Total</h3>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                    <div class="d-flex justify-content-center flex-column align-items-center">

                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Total Due Amount</th>
                                            <th>Total Paid Amount</th>
                                            <th>Total Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rs. {{ $totalAmount }}</td>
                                            <td>Rs. {{ $paidAmount }}</td>
                                            <td>Rs. {{ $totalAmount - $paidAmount  }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection