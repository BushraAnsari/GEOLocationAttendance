@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Attendance Logs</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Attendance</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Logs</a></li>
  
    </ol>
</div>
@endsection


@section('content')
@include('includes.flash')


                      <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<!-- Log on to bntech.com for more projects! -->
                                                <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                                    <thead class="thead-dark">
                                                    <tr>
                                                        <th data-priority="1">Date</th>
                                                        <th data-priority="2">Time in</th>
                                                        <th data-priority="3">Work Hours</th>
                                                        <th data-priority="4">Status</th>
                                                
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $logs as $log)

                                                        <tr>
                                                            <td>{{$log->attendance_date}}</td>
                                                            <td>{{$log->attendance_time}}</td>
                                                            <td>{{$log->work_hours}}</td>
                                                            <td>@if($log->status=="1") <span class="text-success">On Time </span> @else <span class="text-danger">Late</span> @endif</td>
                                                         </tr>
                                                        @endforeach
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
									<!-- Log on to bntech.com for more projects! -->
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->    
                                    





@endsection


@section('script')
<!-- Responsive-table-->

@endsection