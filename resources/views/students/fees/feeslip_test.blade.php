<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>feeslip</title>
    <style>

        .uk {
            font-size: 85px;
            color: darkblue;
            margin-top: -16px;
            text-decoration: underline;
        }

        .uk_inst {
            font-size: 37px;
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


    </style>
</head>

<body>
    
<div id="printable">
    <button class="print">
        Print this
    </button>
    <div class="">
        <div class="container px-0">
            <div class="row">
                <div class="col-12 col-lg-12 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="">
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
                            <div class="">

                                <div class="my-1 text-center copy px-1 py-1">
                                    STUDENT COPY
                                </div>

                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-5 align-self-start d-flex  justify-content-end">
                            <div class="d-flex flex-column">
                                {{-- <div>
                                    <span class="text-sm align-middle">Name:</span>
                                    <span class="text-600 text-110 text-blue align-middle">Sami Rehman</span>
                                </div> --}}
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
                                <tr>
                                    <td>Monthly Fee</td>
                                    <td class="text-secondary-d2">Rs.1000</td>
                                    <td class="text-secondary-d2">Rs.1000</td>
                                    <td class="text-secondary-d2">Rs.0</td>
                                    <td>Feb-2021</td>
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
    <hr>
    <div class="container">
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="">
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
                            <div class="">

                                <div class="my-1 text-center copy px-1 py-1">
                                    STUDENT COPY
                                </div>

                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-5 align-self-start d-flex  justify-content-end">
                            <div class="d-flex flex-column">
                                {{-- <div>
                                    <span class="text-sm align-middle">Name:</span>
                                    <span class="text-600 text-110 text-blue align-middle">Sami Rehman</span>
                                </div> --}}
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
                                <tr>
                                    <td>Monthly Fee</td>
                                    <td class="text-secondary-d2">Rs.1000</td>
                                    <td class="text-secondary-d2">Rs.1000</td>
                                    <td class="text-secondary-d2">Rs.0</td>
                                    <td>Feb-2021</td>
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
    <hr>
    <div class="container">
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="">
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
                            <div class="">

                                <div class="my-1 text-center copy px-1 py-1">
                                    STUDENT COPY
                                </div>

                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-5 align-self-start d-flex  justify-content-end">
                            <div class="d-flex flex-column">
                                {{-- <div>
                                    <span class="text-sm align-middle">Name:</span>
                                    <span class="text-600 text-110 text-blue align-middle">Sami Rehman</span>
                                </div> --}}
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
                                <tr>
                                    <td>Monthly Fee</td>
                                    <td class="text-secondary-d2">Rs.1000</td>
                                    <td class="text-secondary-d2">Rs.1000</td>
                                    <td class="text-secondary-d2">Rs.0</td>
                                    <td>Feb-2021</td>
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
</div>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jQuery.print.min.js') }}"></script>
<script>
    $(function() {
2
	  $("#printable").find('.print').on('click', function() {
3
	    $.print("#printable");
4
	  });
5
	});
</script>

</body>

</html>
