<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        body {
                font-family: "Poppins", sans-serif;
                font-weight: 700;
                font-size: 12px;
                line-height: 1.625;
                color: rgb(61, 60, 60);
            }

        .uk {
            font-size: 85px;
            color: darkblue;
            margin-top: -16px;
            text-decoration: underline;
        }

        .uk_inst {
            font-size: 20px;
            margin-top: -5px;
            color: darkblue;
            padding-bottom: 10px;
        }

        .tnbf {
            text-align: right;
            color: darkblue;
            margin-top: -24px;
            font-size: 28px;
        }

        .instructions {
            margin-left: 40px;
            border: 1px solid blue;
            padding: 3px 7px;
            border-radius: 5px;
            background-color: blue;
            color: white;
        }

        .ftr {
            height: 40px;
            background-color: #4a8cb3
        }

        .ftr p {
            font-size: 12px;
            color: white;
            padding-top: 10px;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }


        .align-bottom {
            vertical-align: bottom !important;
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .px-0 {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px
        }

        .mt-1,
        .my-1 {
            margin-top: .25rem !important
        }

        .mb-1,
        .my-1 {
            margin-bottom: .25rem !important
        }

        .mt-4 {
            margin-top: 1.5rem !important
        }

        .col-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%
        }

        .col-lg-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%
        }

        .offset-lg-1 {
            margin-left: 8.333333%
        }

        .col-lg-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%
        }

        .col-sm-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%
        }

        .col-sm-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%
        }

        .align-self-start {
            -ms-flex-item-align: start !important;
            align-self: flex-start !important
        }

        .d-flex {
            display: -ms-flexbox !important;
            display: flex !important
        }

        .flex-column {
            -ms-flex-direction: column !important;
            flex-direction: column !important
        }

        .justify-content-end {
            -ms-flex-pack: end !important;
            justify-content: flex-end !important
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important
        }

        .mr-4,
        .mx-4 {
            margin-right: 1.5rem !important
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important
        }

        table {
            border-collapse: collapse
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6
        }

        .table-bordered {
            border: 1px solid #dee2e6
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px
        }

        .text-white {
            color: #fff !important
        }

        .mt-lg-0 {
            margin-top: 0 !important
        }

        .mt-2 {
            margin-top: .5rem !important
        }

        .col-sm-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%
        }

        .ml-1 {
            margin-left: .25rem !important
        }

        .order-first {
            -ms-flex-order: -1;
            order: -1
        }

        .order-sm-last {
            -ms-flex-order: 13;
            order: 13
        }

        .text-right {
            text-align: right !important
        }

        .col-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%
        }

        .col-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%
        }

        .col-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%
        }

        .px-1 {
            padding-right: .25rem !important;
            padding-left: .25rem !important;
        }

        .py-1 {
            padding-bottom: .25rem !important;
            padding-top: .25rem !important;
        }

        .ml-4 {
            margin-left: 1.5rem !important
        }

        .col-lg-2 {
            -ms-flex: 0 0 22.666667%;
            flex: 0 0 22.666667%;
            max-width: 22.666667%
        }

        .mx-3 {
            margin-left: 1rem !important;
            margin-right: 1rem !important;
        }

        .text-center {
            text-align: center !important
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem
        }

    </style>
</head>
<body>
    
    
    --------------------------------------------------------------------------------------------------------------------------------------------------------
    <div class="">
        <div class=" px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="" alt="" style="width: 50px; height: 50px">
                        </div>
                        <div class="mx-3">
                            <h1 class="uk">UK</h1>
                        </div>
                        <div>
                            <p class="uk_inst" style="word-spacing: 23px">INSTITUTE OF COMPUTER SCIENCE</p>
                            <p class="uk_inst" style="margin-top: -28px; word-spacing: 5px;">AND ENGLISH LANGUAGE
                                PESHAWAR</p>
                            <div class="tnbf">
                                <p>TEACH NATION BUILD FUTURE</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class=" col-sm-5">
                            <div class="">

                                <div class="my-1">
                                    <strong>Slip No.</strong> 101
                                </div>
                                <div class="my-1">
                                    <strong>Name:</strong> Sami ur Rehman
                                </div>
                                <div class="my-1">
                                    <strong>Father Name:</strong> Khan Wazir
                                </div>


                            </div>
                        </div>
                        <!-- /.col -->

                        <div class=" col-sm-2">
                                <div class="my-1 text-center copy px-1 py-1">
                                    STUDENT COPY
                                </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-5 align-self-start d-flex  justify-content-end">
                            <div class="d-flex flex-column">
                                
                                <div class="">
                                    <div class="my-1">
                                        <strong>Issued Date:</strong> 01-11-2021
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->

                    </div>
                    <div class="row col-lg-12">

                        <div class="my-1 mr-4">
                            <strong> Course:</strong> DIT
                        </div>
                        <div class="my-1 mx-4">
                            <strong>Timing:</strong> 10:00am - 12:00pm
                        </div>
                        <div class="my-1 mx-4">
                           <strong> Teacher:</strong> Nazeer
                        </div>
                        <div class="my-1 mx-4">
                            <strong> Student Contact:</strong> 03102323230
                        </div>

                    </div>

                    <!-- or use a table instead -->
                    <div class="row">
                        <table class="table table-bordered brc-default-l1">
                            <thead class="bgc-default-tp1">
                                <tr class="text-white">
                                    <th>Description</th>
                                    <th>Total</th>
                                    <th width="140">Paid</th>
                                    <th>Balance</th>
                                    <th>Month</th>
                                </tr>
                            </thead>

                            <tbody class=" ">
                                <tr>
                                    <td>Admission Fee</td>
                                    <td class="text-secondary-d2">Rs.2000</td>
                                    <td class="text-secondary-d2">Rs.2000</td>
                                    <td class="text-secondary-d2">Rs.0</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Monthly Fee</td>
                                    <td class="text-secondary-d2">Rs.1000</td>
                                    <td class="text-secondary-d2">Rs.1000</td>
                                    <td class="text-secondary-d2">Rs.0</td>
                                    <td>Feb-2021</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-1">
                        <div class="col-12 col-sm-7  mt-2 mt-lg-0">
                            <div>
                                <strong><span class="instructions">IMPORTANT INSTRUCTIONS</span></strong>
                            </div>
                            <ul class="mt-2">
                                <li>Institute will be closed on Saturday and Sunday</li>
                                <li>Fee must be paid on time and fee once paid is not refundable</li>
                                <li>Students leaving course in the middle will take admission again</li>
                                <li>SMS : 0311-4691010 or CALL : 0310-9737117</li>
                            </ul>
                            <div class="mt-4">
                                <span class="ml-1"><strong>Signature:</strong> _________________________________</span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-5 order-first order-sm-last">
                            <div class="">
                                <table class="table table-bordered brc-default-l1 "style="width: 460px; margin-left: 31px;">
                                    <tbody class=" ">
                                        <tr>
                                            <td class="text-right" style="width: 193px;">Total</td>
                                            <td class="">Rs.3000</td>
                                        </tr>
                                        <tr>
                                            <td class=" text-right" style="width: 193px;">Paid</td>
                                            <td class="">Rs.3000</td>
                                        </tr>
                                        <tr>
                                            <td class="col-7 text-right">Balance</td>
                                            <td class="col-5">Rs.0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="text-center mt-2 ftr col-lg-12">
                            <p>Add: UK Institute Near Govt College Chowk, Opp. Brilliant College Faqirabad Pesh. <span
                                    class="ml-4 mr-4"></span> www.ukicsel.com | infoukicsel@gmail.com |
                                www.facebook.com/infoukicsel</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --------------------------------------------------------------------------------------------------------------------------------------------------------
    
    --------------------------------------------------------------------------------------------------------------------------------------------------------
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center">

        <div class="col-lg-10 row m-b-30">
            <div class="row col-lg-10">
                <p>
                    <strong>Slip No : </strong>{{ $feeslip['id'] }}
                    <strong>  Student Reg.No : </strong>{{ $feeslip['student']['id'] }}
                    <strong>  Student Name : </strong>{{ $feeslip['student']['first_name'].' '.$feeslip['student']['last_name'] }}
                    <strong>  Father Name : </strong>{{ $feeslip['student']['father_name'] }}
                    <strong>  Student Contact : </strong>{{ $feeslip['student']['mobile'] }}
                    <strong>  Father Contact : </strong>{{ $feeslip['student']['father_contact'] }}
                    <strong>  Home Address : </strong>{{ $feeslip['student']['address'] }}
                </p>
            </div>
            <div class="col-lg-2">
                <div class="profile_picture_display">
                    {{-- <img class="profile_img" src="{{ URL($feeslip['student']['image']) }}" alt=""> --}}
                </div>
            </div>
        </div>
        <div class="col-md-10 ">
            <!-- DATA TABLE -->
            
            <div class="d-flex align-items-center justify-content-center flex-column">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Balance</th>
                            <th>Month</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php 
                            $i = 0;
                            $totalAmount = 0; 
                            $paidAmount = 0;
                            // $totalBalance = 0;
                        @endphp
                        @foreach ($feeslip['fees'] as $fee)

                            <tr>
                                
                                <td>
                                    {{ $fee->fee_type }}
                                </td>
                                <td>
                                    {{ $fee->total_amount }}
                                    @php
                                        $totalAmount += $fee->total_amount
                                    @endphp
                                </td>
                                <td>
                                    {{ $fee->paid_amount }}
                                    @php
                                        $paidAmount += $fee->paid_amount
                                    @endphp
                                </td>
                                <td>
                                    {{ $fee->balance }}
                                </td>
                                <td>
                                    {{ $fee->for_month . '-'.  $fee->for_year }}
                                </td>

                            </tr>
                            {{-- <tr class="spacer"></tr> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
            <div class="d-flex align-items-center justify-content-center">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th class="text-right">Total Amount</th><td>{{ $feeslip['total_amount'] }}</td>
                            <th class="text-right">Total Paid</th><td>{{ $feeslip['paid_amount'] }}</td>                   
                            <th class="text-right">Balance</th><td>{{ $feeslip['total_amount'] - $feeslip['paid_amount']  }}</td>
                        </tr>
                    </thead>
                </table>
                
            </div>
        </div>
    </div>
    
    
</body>
</html>

