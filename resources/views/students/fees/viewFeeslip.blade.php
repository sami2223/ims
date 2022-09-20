@extends('layouts.admin')

@section('pageTitle')
    Slip No. {{ $feeslip->id }}
@endsection


@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Fee Slip</h3>
                    <div class="float-right">
                        @if (count($feeslip->fees) < 3)
                            <a href="{{ route('students.createNewFee', $feeslip->id) }}" class="btn btn-success">
                                Add New Fee
                            </a>
                        @else
                            Warning! You cannot add more than three records on this slip.
                        @endif

                        <button id="print" class="btn btn-success mx-2">
                            Print Slip
                        </button>
                        <a class="btn btn-success" href="{{ route('fees.index') }}">Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div id="printableDisplay" class="mx-3">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row mx-4">
                                    <div class="col-md-2">
                                        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="">
                                    </div>
                                    <div class="col-md-10" style="padding-right: 16px;">
                                        <div class="row  float-right">
                                            <div>
                                                <h1 class="uk">UK</h1>
                                            </div>
                                            <div class="ml-2">
                                                <div class="">
                                                    <p class="uk_inst pbt" style="word-spacing: 11px">INSTITUTE OF COMPUTER
                                                        SCIENCE
                                                    </p>
                                                    <p class="uk_inst pbt" style="margin-top: -28px; word-spacing: 1px;">AND
                                                        ENGLISH
                                                        LANGUAGE
                                                        PESHAWAR</p>
                                                    <div class="tnbf">
                                                        <p>TEACH NATION BUILD FUTURE</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mx-4">
                                    <div class="col-md-5">
                                        <div class="">
                                            <div class="my-1">
                                                <strong>Slip No. </strong> {{ $feeslip->id }}
                                            </div>
                                            <div class="my-1">
                                                <strong>Name: </strong>
                                                {{ $feeslip->Student->first_name . ' ' . $feeslip->Student->last_name }}
                                            </div>
                                            <div class="my-1">
                                                <strong>Father Name:</strong> {{ $feeslip->Student->father_name }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-2">
                                        <div class="">

                                            <div class="my-1 text-center copy px-1 py-1"
                                                style="background-color: rgb(12, 176, 191); color:white; border-radius:5px">
                                                <strong>STUDENT COPY</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-5">
                                        <div class="float-right">
                                            <div class="my-1">
                                                <strong>Issued Date:</strong> {{ $feeslip->created_at->format('d-m-Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mx-4">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <strong>Course:</strong> {{ $feeslip->Student->course->course }}
                                            </div>
                                            <div class="">
                                                <strong>Timing:</strong>
                                                {{ $feeslip->Student->timing->from . ' - ' . $feeslip->Student->timing->to }}
                                            </div>
                                            <div class="">
                                                <strong> Teacher:</strong> {{ $feeslip->Student->course->teacher->name }}
                                            </div>
                                            <div class="">
                                                <div class="float-right">
                                                    <strong> Student Contact:</strong> {{ $feeslip->Student->mobile }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- table -->
                                <div class="row mx-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Total</th>
                                                    <th>Paid</th>
                                                    <th>Balance</th>
                                                    <th>Month</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @php
                                                    $totalAmount = 0;
                                                    $paidAmount = 0;
                                                    // $totalBalance = 0;
                                                @endphp
                                                @foreach ($feeslip->fees as $fee)
                                                    <tr>
                                                        <td>{{ $fee->fee_type }}</td>
                                                        <td>
                                                            Rs. {{ $fee->total_amount }}
                                                            @php
                                                                $totalAmount += $fee->total_amount;
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            Rs. {{ $fee->paid_amount }}
                                                            @php
                                                                $paidAmount += $fee->paid_amount;
                                                            @endphp
                                                        </td>
                                                        <td>Rs. {{ $fee->balance }}</td>
                                                        <td>{{ $fee->for_month . '-' . $fee->for_year }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary" title="Edit"> 
                                                               {{-- <i class="fas fa-pen"></i> --}}
                                                               Edit
                                                            </a>
                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <div class="row mx-3">
                                            <div class="col-md-6  mt-2 mt-lg-0">
                                                <div>
                                                    <strong><span class="instructions">IMPORTANT
                                                            INSTRUCTIONS</span></strong>
                                                </div>
                                                <ul class="mt-2">
                                                    <li>Institute will be closed on Saturday and Sunday</li>
                                                    <li>Fee must be paid on time and fee once paid is not refundable</li>
                                                    <li>Students leaving course in the middle will take admission again</li>
                                                    <li>SMS : 0311-4691010 or CALL : 0310-9737117</li>
                                                </ul>
                                                <div class="mt-4">
                                                    <span class="ml-1"><strong>Signature:</strong>
                                                        _________________________________</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="float-right">
                                                    <table class="table table-bordered" style="width: 300px;">
                                                        <tbody class=" ">
                                                            <tr>
                                                                <td style="width: 156px;"><strong> Total</strong></td>
                                                                <td class="">Rs. {{ $feeslip->total_amount }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style=""><strong>Paid</strong></td>
                                                                <td class="">Rs. {{ $feeslip->paid_amount }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class=""><strong>Balance</strong></td>
                                                                <td class="">Rs.
                                                                    {{ $feeslip->total_amount - $feeslip->paid_amount }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="text-center mt-2 ftr col-lg-12">
                                        <p>Add: UK Institute Near Govt College Chowk, Opp. Brilliant College Faqirabad
                                            Pesh. <span class="ml-4 mr-4"></span> www.ukicsel.com |
                                            infoukicsel@gmail.com |
                                            www.facebook.com/infoukicsel</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="printable" class="mx-3">


                        @for ($i = 0; $i < 3; $i++)
                            @if ($i == 0)
                                @php
                                    $copy = 'STUDENT COPY';
                                @endphp
                            @elseif($i == 1)
                                @php
                                    $copy = 'BANK COPY';
                                @endphp
                            @elseif($i == 2)
                                @php
                                    $copy = 'UKICSEL COPY';
                                @endphp
                            @endif
                            <div>
                                <div class="row">
                                    <div class="col-lg-12 offset-lg-1">
                                        <div class="row">
                                            <div class="">
                                                <img src="{{ asset('images/icon/header.JPG') }}" alt=""
                                                    style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-10 offset-lg-1">
                                        <div class="row">
                                            <div class=" col-sm-5">
                                                <table class="" style="font-size: 14px">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Student Name:</strong></td>
                                                            <td class="pl-2">
                                                                {{ $feeslip->Student->first_name . ' ' . $feeslip->Student->last_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Father's Name:</strong></td>
                                                            <td class="pl-2">{{ $feeslip->Student->father_name }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <!-- /.col -->

                                            <div class=" col-sm-2">
                                                <div class="">

                                                    <div class=" text-center copy px-1 py-1"
                                                        style="background-color: rgb(12, 176, 191); color:white; border-radius:5px">
                                                        <strong>{{ $copy }}</strong>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- /.col -->

                                            <div class="col-sm-5 align-self-start d-flex  justify-content-end">
                                                <table class="" style="font-size: 14px; width:48%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 104px;"><strong>Slip No.</strong></td>
                                                            <td class="text-right">{{ $feeslip->id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Issued Date:</strong></td>
                                                            <td class="text-right">
                                                                {{ $feeslip->created_at->format('d-m-Y') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <!-- /.col -->

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="" style="font-size:14px; width:100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 102px;"><strong> Course:</strong></td>
                                                            <td style="width: 137px;">
                                                                {{ $feeslip->Student->batch->batch_name }}</td>
                                                            <td style="width: 55px;"><strong>Timing:</strong></td>
                                                            <td style="width: 135px;">
                                                                {{ $feeslip->Student->timing->from . ' - ' . $feeslip->Student->timing->to }}
                                                            </td>
                                                            <td style="width: 60px"><strong> Teacher:</strong></td>
                                                            <td style="width: 250px;">
                                                                {{ $feeslip->Student->course->teacher->employee_name }}
                                                            </td>
                                                            <td class="text-right"><strong> Student Contact:</strong></td>
                                                            <td class="text-right" style="width: 82px;">
                                                                {{ $feeslip->Student->mobile }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                        <!-- or use a table instead -->
                                        <div class="row">
                                            <table class="table-bordered"
                                                style="font-size:14px; width:100%;margin-bottom:1rem;">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Total</th>
                                                        <th>Paid</th>
                                                        <th>Balance</th>
                                                        <th>Month</th>
                                                    </tr>
                                                </thead>
                                                @php
                                                    $totalAmount = 0;
                                                    $paidAmount = 0;
                                                    // $totalBalance = 0;
                                                @endphp
                                                <tbody class="text-center">
                                                    @foreach ($feeslip->fees as $fee)
                                                        <tr>
                                                            <td>{{ $fee->fee_type }}</td>
                                                            <td>
                                                                Rs. {{ $fee->total_amount }}
                                                                @php
                                                                    $totalAmount += $fee->total_amount;
                                                                @endphp
                                                            </td>
                                                            <td>
                                                                Rs. {{ $fee->paid_amount }}
                                                                @php
                                                                    $paidAmount += $fee->paid_amount;
                                                                @endphp
                                                            </td>
                                                            <td>Rs. {{ $fee->balance }}</td>
                                                            <td>{{ $fee->for_month . '-' . $fee->for_year }}</td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-7  mt-1 mt-lg-0" style="font-size:14px;">
                                                {{-- <div>
                                                    <strong><span class="instructions">IMPORTANT INSTRUCTIONS</span></strong>
                                                </div>
                                                <ul class="mt-2" style="margin-bottom: 0rem;">
                                                    <li>Institute will be closed on Saturday and Sunday</li>
                                                    <li>Fee must be paid on time and fee once paid is not refundable</li>
                                                    <li>Students leaving course in the middle will take admission again</li>
                                                    <li>SMS : 0311-4691010 or CALL : 0310-9737117</li>
                                                </ul> --}}
                                                <img src="{{ asset('images/icon/instructions.JPG') }}"
                                                    style="width: 70%;">
                                            </div>

                                            <div class="col-12 col-sm-5 order-first order-sm-last">
                                                <div class="" style="margin-left: 15px;">
                                                    <table class="table-bordered"
                                                        style="width: 358px; margin-left: 29px; font-size:14px;">
                                                        <tbody class="text-center">
                                                            <tr>
                                                                <td style="width: 173px;"><strong> Total</strong></td>
                                                                <td class="">Rs. {{ $feeslip->total_amount }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style=""><strong>Paid</strong></td>
                                                                <td class="">Rs. {{ $feeslip->paid_amount }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class=""><strong>Balance</strong></td>
                                                                <td class="">Rs.
                                                                    {{ $feeslip->total_amount - $feeslip->paid_amount }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="mt-4">
                                                        <span
                                                            style="margin-left: 22px"><strong>Signature:</strong>________________________________</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="text-center ftr col-lg-12">
                                                <p>Address: UK Institute Near Govt College Chowk, Opp. Brilliant College
                                                    Faqirabad
                                                    Peshawar. <span class="mx-4"></span> www.ukicsel.com |
                                                    infoukicsel@gmail.com |
                                                    www.facebook.com/infoukicsel</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($i != 2)
                                <hr>
                            @endif
                        @endfor
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jQuery.print.min.js') }}"></script>
    <script>
        $("#printable").hide();
        // $("#printableDisplay").hide();

        $(function() {
            $('#print').on('click', function() {
                $("#printable").show();
                $.print("#printable");
                $("#printable").hide();
            });
        });
    </script>
@endsection
