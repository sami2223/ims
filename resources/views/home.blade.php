@extends('layouts.admin')

@section('pageTitle')
    Dashboard
@endsection
@section('pageTitle2')
    Dashboard
@endsection

@section('content')

    <!-- PAGE CONTENT-->
    <!-- WELCOME-->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Students</span>
                            <span class="info-box-number">
                                {{ count($students) }}
                                {{-- <small>%</small> --}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Courses</span>
                            <span class="info-box-number">{{ count($courses) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Teachers</span>
                            @php
                                $countTeachers = 0;
                                if(!empty($designations)){
                                    foreach ($designations as $designation){                             
                                        foreach ($designation->Employees as $teacher){
                                                $countTeachers++;
                                        } 
                                    }      
                                }
                            @endphp
                            <span class="info-box-number">{{ $countTeachers }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Admin Users</span>
                            <span class="info-box-number">{{ count($users) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Monthly Recap Report</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <div class="btn-group">
                      <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-wrench"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="#" class="dropdown-item">Action</a>
                        <a href="#" class="dropdown-item">Another action</a>
                        <a href="#" class="dropdown-item">Something else here</a>
                        <a class="dropdown-divider"></a>
                        <a href="#" class="dropdown-item">Separated link</a>
                      </div>
                    </div> --}}
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button> --}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">           

                                    <div class="chart">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class="___class_+?47___"></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class="___class_+?49___"></div>
                                            </div>
                                        </div>
                                        <!-- Sales Chart Canvas -->
                                        <canvas id="myChart" style="height: 180px; display: block; width: 680px;"
                                            class="chartjs-render-monitor" width="680" height="180"></canvas>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                        {{-- <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                            17%</span>
                                        <h5 class="description-header">$35,210.43</h5>
                                        <span class="description-text">TOTAL REVENUE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                            0%</span>
                                        <h5 class="description-header">$10,390.90</h5>
                                        <span class="description-text">TOTAL COST</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                            20%</span>
                                        <h5 class="description-header">$24,813.53</h5>
                                        <span class="description-text">TOTAL PROFIT</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                            18%</span>
                                        <h5 class="description-header">1200</h5>
                                        <span class="description-text">GOAL COMPLETIONS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div> --}}
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- END WELCOME-->

    <script>
        var _ydata = JSON.parse('{!! json_encode($months) !!}');
        var _xdata = JSON.parse('{!! json_encode($monthsCount) !!}');
        $(function() {
            'use strict'

            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //-----------------------
            //- MONTHLY STUDENTS REGISTRATION CHART -
            //-----------------------

            // Get context with jQuery - using jQuery's .get() method.
            var myChartCanvas = $('#myChart').get(0).getContext('2d')

            var myChartData = {
                labels: _ydata,
                datasets: [{
                    label: 'Students',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: _xdata
                }]
            }

            var myChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position: 'bottom'
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month',
                        },
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 10,
                            
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var myChart = new Chart(myChartCanvas, {
                type: 'line',
                data: myChartData,
                options: myChartOptions
            })

            //---------------------------
            //- END MONTHLY SALES CHART -
            //---------------------------

        })
        
    </script>
@endsection
