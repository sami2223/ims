@extends('layouts.admin')
@section('pageTitle')
    Fee Management
@endsection

{{-- @php
if (count($fee) > 0) {
    $total = 0;
    $paid = 0;

    foreach ($fee as $fees) {
        $total = $total + $fees->total_amount;
        $paid = $paid + $fees->paid_amount;
        $balance = $total - $paid;
    }
}

@endphp --}}


@section('content')

    {{-- DataTable --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fee Details for <strong>{{ $student->first_name }}</strong> having 
                        <strong>Reg. No. {{ $student->id }}</strong>, Enrolled in 
                        @if(!empty($student->Course))
                        <strong>Course {{ $student->Course->course }}</strong>  </h3> 
                        @else
                        <strong>Course </strong> (Course is missing)</h3> 
                        @endif
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('students.createFee', [$student->id]) }}">Create New Slip</a>
                        <a class="btn btn-success" href="{{ route('fees.index') }}">Back</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (count($feeSlips) == 0)
                        <p> No record found</p>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Slip No.</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Balance</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feeSlips as $feeSlip)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $feeSlip->id }}</td>
                                            <td>{{ $feeSlip->total_amount }}</td>
                                            <td>{{ $feeSlip->paid_amount }}</td>
                                            <td>{{ $feeSlip->total_amount - $feeSlip->paid_amount }}</td>
                                            <td>{{ $feeSlip->created_at }}</td>
                                            <td>
                                                <a href="{{ route('fees.showDetails', [$feeSlip->id]) }}"
                                                    class="btn btn-info btn-block">
                                                    View Slip</a>
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


@endsection
