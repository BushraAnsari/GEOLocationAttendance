@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Dashboard</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to  Dayfresh CC Program-KLI</li>
     </ol>
</div>
@endsection

@section('content')
                   <div class="row">
                           
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-secondary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-left mini-stat-img mr-4">
                                        <i class=" ti-check-box " style="font-size: 30px"></i>
                                    </div>
                                    <h5 class="font-16 text-uppercase mt-0 text-white-50">Total Count <br> This Month</h5>
                                    
                                     
                                </div>
                                <!-- Log on to bntech.com for more projects! -->
                                <h1 class="font-500 float-right">{{$data[0]}} <i class=" text-success ml-2"></i></h1>
               
                                <!-- <div class="pt-2">
                                    <div class="float-right">
                                        <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                    </div>

                                    <p class="text-white-50 mb-0">More info</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class=" ti-check-box " style="font-size: 30px"></i>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">On Time <br> This Month</h5>
                                            
                                             
                                        </div>
										<!-- Log on to bntech.com for more projects! -->
                                        <h1 class="font-500 float-right">{{$data[1]}} <i class=" text-success ml-2"></i></h1>
                                            <span class="peity-donut float-left" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">{{$data[1]}}/{{$data[0]}}</span>
                                        <!-- <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">More info</p>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class="ti-alert" style="font-size: 30px"></i>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">Late <br> This Month</h5>
                                            
                                             
                                        </div>
										<!-- Log on to bntech.com for more projects! -->
                                        <h1 class="font-500 float-right">{{$data[2]}}<i class=" text-success ml-2"></i></h1>
                                            <span class="peity-donut float-left" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">{{$data[2]}}/{{$data[0]}}</span>
                                        <!-- <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">More info</p>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class="ti-alarm-clock" style="font-size: 30px"></i>
                                            </div>
                                            <h6  class="font-16 text-uppercase mt-0 text-white-50" >On Time <br> Percentage</h6>
                                            
                                                       
                                        </div>
                                        <h2 class="font-500 float-right">{{$data[3]}}%<i class="text-danger ml-2"></i></h2>
                                      
                                        <!-- <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">More info</p>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class="ti-alarm-clock" style="font-size: 30px"></i>
                                            </div>
                                            <h6  class="font-16 text-uppercase mt-0 text-white-50" >Total <br> Work Time Today</h6>
                                            
                                                       
                                        </div>
                                        <h2 class="font-500 float-right">{{$data[4]}}<i class="text-danger ml-2"></i></h2>
                                        <!-- <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">More info</p>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
						<!-- Log on to bntech.com for more projects! -->


                        <!-- new row -->
                       
                        <!-- new row end -->
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="card">
                                    <!-- <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5">Monthly Report</h4>
                                        
                                    </div> -->
                                </div>
                                <!-- end card -->
                            </div>

                            <div class="col-xl-3">
                                <div class="card">
                                    <!-- <div class="card-body">
                                        <div>
                                            <h4 class="mt-0 header-title mb-4">Sales Analytics</h4>
                                        </div>
                                       
                                      
                                       </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                        
                        <!-- end row -->
@endsection

