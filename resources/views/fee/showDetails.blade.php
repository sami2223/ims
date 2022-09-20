@extends('layouts.admin')
@section('pageTitle')
    Fee Management
@endsection



@section('content')

    {{-- DataTable --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Details of <strong>Slip No. {{ $slip->id }}</strong> for
                        <strong>{{ $slip->Student->first_name }}</strong> having <strong> Reg. No.
                            {{ $slip->Student->reg_no }}</strong>, Enrolled in <strong>Course
                            @if ($slip->Student->Course != null)
                                {{ $slip->Student->Course->course }}
                        </strong>
                    @else
                        (Course is missing)
                        @endif

                    </h3>
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('fees.show', $slip->Student->id) }}">Back</a>
                    </div>
                </div>
                <!-- /.card-body -->
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
                                                <strong>Slip No. </strong> {{ $slip->id }}
                                            </div>
                                            <div class="my-1">
                                                <strong>Name: </strong>
                                                {{ $slip->Student->first_name . ' ' . $slip->Student->last_name }}
                                            </div>
                                            <div class="my-1">
                                                <strong>Father Name:</strong> {{ $slip->Student->father_name }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-2">
                                        <div class="">

                                            <div class="my-1 text-center copy px-1 py-1"
                                                style="background-color: rgb(12, 176, 191); color:white; border-radius:5px">
                                                <strong>UKISCEL COPY</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-5">
                                        <div class="float-right">
                                            <div class="my-1">
                                                <strong>Issued Date:</strong> {{ $slip->created_at->format('d-m-Y') }}
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
                                                <strong>Course:</strong> {{ $slip->Student->course->course }}
                                            </div>
                                            <div class="">
                                                <strong>Timing:</strong>
                                                {{ $slip->Student->timing->from . ' - ' . $slip->Student->timing->to }}
                                            </div>
                                            <div class="">
                                                <strong> Teacher:</strong> {{ $slip->Student->course->teacher->name }}
                                            </div>
                                            <div class="">
                                                <div class="float-right">
                                                    <strong> Student Contact:</strong> {{ $slip->Student->mobile }}
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
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @php
                                                    $totalAmount = 0;
                                                    $paidAmount = 0;
                                                    // $totalBalance = 0;
                                                @endphp
                                                @foreach ($slip->fees as $fee)
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
                                                                <td class="">Rs. {{ $slip->total_amount }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style=""><strong>Paid</strong></td>
                                                                <td class="">Rs. {{ $slip->paid_amount }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class=""><strong>Balance</strong></td>
                                                                <td class="">Rs.
                                                                    {{ $slip->total_amount - $slip->paid_amount }}
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
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
        </div>
    </div>



@endsection
