@extends('layouts.admin')
@section('pageTitle')
    Fee Management
@endsection

@php
if (count($fee) > 0) {
    $total = 0;
    $paid = 0;

    foreach ($fee as $fees) {
        $total = $total + $fees->total_amount;
        $paid = $paid + $fees->paid_amount;
        $balance = $total - $paid;
    }
}

@endphp


@section('content')

    {{-- DataTable --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Results for <strong>Slip No. {{ $slipNo }}</strong></h3>
                    <div class="float-right">
                        <h3 class="card-title"><a class="btn btn-success" href="{{ route('fees.index') }}">Back</a></h3>
                    </div>
                </div>

                <div class="card-body">
                    @if (count($fee) == 0)
                        <p> No record found</p>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>Slip No.</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Contact</th>
                                    <th>Course</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Balance</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fee as $fees)
                                    <tr>
                                        <td>{{ $fees->slip_id }}</td>
                                        <td>{{ $fees->Student->first_name . ' ' . $fees->Student->last_name }}</td>
                                        <td>{{ $fees->Student->father_name }}</td>
                                        <td>{{ $fees->Student->mobile }}</td>
                                        <td>
                                            @if ($fees->Student->Course != null)
                                                {{ $fees->Student->Course->course }}
                                            @endif
                                        </td>

                                        <td>{{ $total }}</td>
                                        <td>{{ $paid }}</td>
                                        <td>{{ $balance }}</td>
                                        <td>{{ $fees->FeeSlip->created_at }}</td>
                                        <td>
                                            <a href="{{ route('fees.showDetails', [$fees->slip_id]) }}"
                                                class="btn btn-info btn-block">
                                                View Slip</a>
                                        </td>
                                    </tr>
                                @break
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

    {{-- <div id="details" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Slip Details</h3>
                </div>

                <!-- /.card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">

                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                        SNo
                                    </th>
    
                                    
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">
                                        Reg.No
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending">
                                        Fee Amount
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending">
                                        Paid Amount
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                        Balance
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending">
                                        Fee Type
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                        For Month
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($fee as $fee)
                                    <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1">{{ ++$i }}</td>
                                        <td>{{ $fee->Student->id }}</td>
                                        <td>{{ $fee->total_amount }}</td>
                                        <td>{{ $fee->paid_amount }}</td>
                                        <td>{{ $fee->balance }}</td>
                                        <td>{{ $fee->fee_type }}</td>
                                        <td>{{ $fee->for_month.'-'.$fee->for_year }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div> --}}

    {{-- <script>
        $(document).ready(function() {

            $('#details').hide();
            var status = 0;
            console.log(status);

            $('#btn').click(function() {
                if (status == 0) {
                    $('#details').show();
                    $('#btn i').removeClass('fa-chevron-down');
                    $('#btn i').addClass('fa-chevron-up');
                    status = 1;
                } else {
                    $('#details').hide();
                    $('#btn i').removeClass('fa-chevron-up');
                    $('#btn i').addClass('fa-chevron-down');
                    status = 0;
                }

            })

        })
    </script> --}}

@endsection
