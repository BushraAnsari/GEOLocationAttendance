<?php
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');
    if (func_num_args() == 0) {
        return $flash;
    }
    return $flash->info($title, $message);
}
function get_latetime($start, $end)
{
    $start = Carbon::parse($start);
    $end = Carbon::parse($end);
    return $start->diffForHumans($end);
}

function status_att($start, $end)
{
    $start = Carbon::parse($start);
    $end = Carbon::parse($end);
    if ($start->LessThan($end) || $start->equalTo($end))
        return '<span class="badge badge-success badge-pill float-right">On Time</span>';
    else
        return '<span class="badge badge-danger badge-pill float-right">Late</span>';
}
function status_attr($start, $end)
{
    $start = Carbon::parse($start);
    $end = Carbon::parse($end);
    if ($start->LessThan($end) || $start->equalTo($end))
        return 1;
    else
        return 0;
}
function att_name_filter(){

return DB::table('employees')->get();
}
function att_schedule_filter(){

    return DB::table('schedules')->get();
    }
function date_filter(){
    return DB::table('attendances')
   ->select('attendance_date')
    ->groupBy('attendance_date')
    ->get();
}


?>