@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css"
        media="screen">
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Attendance</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Attendance</a></li>


        </ol>
    </div>
@endsection
@section('button')
    <a href="check" class="btn btn-success btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add New</a>
@endsection

@section('content')
    @include('includes.flash')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="name_filter" class="control-label">Name</label>


                            <select class="form-control" id="name_filter" name="name_filter">
                                <option value="" selected>- Select -</option>
                                @foreach (att_name_filter() as $name)
                                    <option value="{{ $name->name }} ({{ $name->id }})"> {{ $name->name }}
                                        ({{ $name->id }})
                                    </option>
                                @endforeach

                            </select>

                        </div>
                        <div class="form-group col-sm-3">
                            <label for="schdeule_filter" class="control-label">Schedule</label>


                            <select class="form-control" id="schedule_filter" name="schedule_filter">
                                <option value="" selected>- Select -</option>
                                @foreach (att_schedule_filter() as $name)
                                    <option value="{{ $name->slug }}"> {{ $name->slug }} </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group col-sm-3">
                            <label for="date_filter" class="control-label">Date</label>


                            <select class="form-control" id="date_filter" name="date_filter">
                                <option value="" selected>- Select -</option>
                                @foreach (date_filter() as $name)
                                    <option value="{{ $name->attendance_date }}"> {{ $name->attendance_date }} </option>
                                @endforeach

                            </select>

                        </div>
                        <div class="form-group col-sm-3">
                            <label for="att_filter" class="control-label">Schedule</label>


                            <select class="form-control" id="att_filter" name="att_filter">
                                <option value="" selected>- Select -</option>
                                <option value="On Time">On Time</option>
                                <option value="Late">Late</option>
                            </select>

                        </div>
                    </div>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable-buttons"
                                class="table table-hover table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead class="thead-dark">
                                    <!-- Log on to bntech.com for more projects! -->
                                    <tr>
                                        <th data-priority="1">Date</th>
                                        <th data-priority="2">Name</th>
                                        <th data-priority="3">Schedule</th>
                                        <th data-priority="4">Time In</th>
                                        <th data-priority="5">Time Out</th>
                                        <th data-priority="6">Work Hours</th>
                                        <th data-priority="7">Late Minutes</th>



                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->attendance_date }}</td>
                                            <td>{{ $attendance->employee->name }} ({{ $attendance->emp_id }})</td>
                                            <td><strong
                                                    id="slug">{{ $attendance->employee->schedules->first()->slug }}</strong><br>
                                                <strong>Entry:
                                                </strong>{{ $attendance->employee->schedules->first()->time_in }}<br>
                                                <strong>Work Hours :</strong>
                                                {{ $attendance->employee->schedules->first()->work_hours }}

                                            </td>
                                            <td> {{ $attendance->attendance_time }}<br>{!! status_att($attendance->attendance_time, $attendance->employee->schedules->first()->time_in) !!}

                                            </td>
                                            <td>
                                                @if ($attendance->last_time_out == null)
                                                    <span class="badge badge-danger badge-pill float-right">Time out not
                                                        inserted</span>
                                                @else
                                                    <span>{{ $attendance->last_time_out }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $attendance->work_hours }} </td>
                                            <td>
                                                @if (status_attr($attendance->attendance_time, $attendance->employee->schedules->first()->time_in) == 0)
                                                    {{ get_latetime($attendance->attendance_time, $attendance->employee->schedules->first()->time_in) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- Log on to bntech.com for more projects! -->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection


@section('script')
    <!-- Responsive-table-->
    <!-- Log on to bntech.com for more projects! -->
    <script src="{{ URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>
@endsection
@section('script-bottom')
    <script>
        $('#date_filter').on('change', function() {
            var input, filter, table, tr, td, i, txtValue;

            input = document.getElementById("date_filter");
            filter = input.value.toUpperCase();
            console.log(filter);
            table = document.getElementById("datatable-buttons");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;

                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
            $('.table-responsive').responsiveTable('update');
        });
        $('#schedule_filter').on('change', function() {
            var input, filter, table, tr, td, i, txtValue;

            input = document.getElementById("schedule_filter");
            filter = input.value.toUpperCase();
            console.log(filter);
            table = document.getElementById("datatable-buttons");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];

                if (td) {
                    strong = td.getElementsByTagName("strong")[0]; // Get the strong element within the td
                    if (strong) {
                        txtValue = strong.textContent || strong.innerText;

                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
            $('.table-responsive').responsiveTable('update');
        });
        $('#att_filter').on('change', function() {
            var input, filter, table, tr, td, i, txtValue;

            input = document.getElementById("att_filter");
            filter = input.value.toUpperCase();
            console.log(filter);
            table = document.getElementById("datatable-buttons");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];

                if (td) {
                    strong = td.getElementsByTagName("span")[0]; // Get the strong element within the td
                    if (strong) {
                        txtValue = strong.textContent || strong.innerText;

                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
            $('.table-responsive').responsiveTable('update');
        });


        $('#name_filter').on('change', function() {
            var input, filter, table, tr, td, i, txtValue;

            input = document.getElementById("name_filter");
            filter = input.value.toUpperCase();
            console.log(filter);
            table = document.getElementById("datatable-buttons");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;

                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
            $('.table-responsive').responsiveTable('update');
        });
    </script>
@endsection
@section('script')
    <script>
        $(function() {

            $('.table-responsive').responsiveTable({
                addDisplayAllBtn: 'btn btn-secondary',
                sort: false,

            });


        });
    </script>
@endsection
