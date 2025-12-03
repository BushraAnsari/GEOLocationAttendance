<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Latetime;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{


    public function logs(){
        $id = Employee::whereEmail(Auth::user()->email)->first()->id;
        return view('employee.logs')->with(['logs'=> Attendance::whereEmp_id($id)->get()]);
    
    }
    public function profile(){
        $employee= Employee::whereEmail(Auth::user()->email)->first();
        $user = User::whereEmail(Auth::user()->email)->first();
        $data = [$employee,$user];
    
        
        return view('employee.profile')->with(['data'=> $data]);
    
    }
    public function index()
    {
        
        $id = Employee::whereEmail(Auth::user()->email)->first()->id;
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        //Dashboard statistics 
        $AllAttendance = count(Attendance::whereBetween('attendance_date', [$startOfMonth, $endOfMonth])->whereEmp_id($id)->get());
        
        $ontimeEmp = count(Attendance::whereBetween('attendance_date', [$startOfMonth, $endOfMonth])->whereStatus('1')->whereEmp_id($id)->get());
        $latetimeEmp = count(Attendance::whereBetween('attendance_date', [$startOfMonth, $endOfMonth])->whereStatus('0')->whereEmp_id($id)->get());
        $workHours = Attendance::whereAttendance_date(date("Y-m-d"))->whereEmp_id($id)->first();
        $workHours= $workHours==null?"00:00:00":$workHours->work_hours;
       
        
       $wt =   Schedule::whereId(DB::table('schedule_employees')->where('emp_id', $id)->first()->schedule_id)->first()->work_hours;
        if ($AllAttendance > 0) {
            $percentageOntime = str_split(($ontimeEmp / $AllAttendance) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }

        $data = [$AllAttendance,$ontimeEmp, $latetimeEmp, $percentageOntime,$workHours,$wt];
       

        return view('employee.index')->with(['data' => $data]);
    }
    public function attendance(Request $request)
    {
       //dd($request->all());
        $user = auth()->user();
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');
        $id = Employee::whereEmail(Auth::user()->email)->first()->id;
        $location =   Schedule::whereId(DB::table('schedule_employees')->where('emp_id', $id)->first()->schedule_id)->first();
        
       
       
        
        if ($employee = Employee::whereEmail(Auth::user()->email)->first()) {

            if (Hash::check($request->pin, $employee->pin_code)){ 
               // dd($location,$request->all());

                if ($location && $this->isWithinLocation($userLatitude, $userLongitude, $location)) {
                if (!Attendance::whereAttendance_date(date("Y-m-d"))->whereEmp_id($employee->id)->first()) {

                $attendance = new Attendance;
                $attendance->emp_id = $employee->id;
                $attendance->attendance_time = date("H:i:s");
                $attendance->last_time_in = date("H:i:s");
                $attendance->attendance_date = date("Y-m-d");

                if (!($employee->schedules->first()->time_in >= $attendance->attendance_time)) {
                    $attendance->status = 0;
                    AttendanceController::lateTime($employee);
                }
                

                $attendance->save();
                flash()->success('Success','Attendance Submited !');
                return back();
            } else 
            {

                $att = Attendance::whereAttendance_date(date("Y-m-d"))->whereEmp_id($employee->id)->first();

                if ($att->last_time_out == null) {
                    $start = Carbon::parse($att->attendance_time); // Start timestamp
                    $end = Carbon::parse(date("H:i:s")); // End timestamp
                    $work_hours = $start->diff($end);
                    $att->last_time_out = date("H:i:s");
                    $att->work_hours = $work_hours->h.":".$work_hours->m.":".$work_hours->s;
                    $att->save();
                    flash()->success('Success','Timeout inserted !');
                    return back();
                   
                } else {
                    if ($att->last_time_out < $att->last_time_in) {
                        $start = Carbon::parse($att->last_time_in); // Start timestamp
                        $end = Carbon::parse(date("H:i:s")); // End timestamp
                        $work_hours = $start->diff($end);
                       

                        $att->last_time_out = date("H:i:s");
                        $att->work_hours = $this->addTimes($att->work_hours,$work_hours->h.":".$work_hours->m.":".$work_hours->s);
                        $att->save();
                        flash()->success('Success','Timeout inserted !');
                        return back();

                    }
                    else{
                        $att->last_time_in = date("H:i:s");
                        $att->save();
                        flash()->success('Success','Timein inserted !');
                        return back();

                    }

                }
            }
        }
    else
    flash()->error('Error','You are '.$this->distance_calculate($userLatitude, $userLongitude, $location).'meters away from the office');
    return back();
}
        else
        flash()->error('Error','Pincode not match !');
        return back();
        }


    }
    function addTimes($timeString1, $timeString2) {
        // Convert time strings to seconds
        list($h1, $m1, $s1) = explode(':', $timeString1);
        list($h2, $m2, $s2) = explode(':', $timeString2);
    
        $seconds1 = ($h1 * 3600) + ($m1 * 60) + $s1;
        $seconds2 = ($h2 * 3600) + ($m2 * 60) + $s2;
    
        // Add the times in seconds
        $totalSeconds = $seconds1 + $seconds2;
    
        // Convert total seconds back to H:M:S
        $hours = intdiv($totalSeconds, 3600);
        $totalSeconds %= 3600;
        $minutes = intdiv($totalSeconds, 60);
        $seconds = $totalSeconds % 60;
    
        return $hours.":".$minutes.":".$seconds;
    }
    function isWithinLocation($lat1, $lon1, $location)
{
    $earth_radius = 6371000; // Radius of the Earth in meters

    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($location->latitude);
    $lon2 = deg2rad($location->longitude);

    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;

    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earth_radius * $c;
    $distance = $distance/1000;

   
    return $distance <= $location->radius;
}

function distance_calculate($lat1, $lon1, $location)
{
    $earth_radius = 6371000; // Radius of the Earth in meters

    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($location->latitude);
    $lon2 = deg2rad($location->longitude);

    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;

    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earth_radius * $c;
    $distance = $distance/1000;

   
    return number_format($distance, 2);;
}


}
