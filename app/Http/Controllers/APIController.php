<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Check;
use App\Models\Leave;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AttendanceEmp;
use Illuminate\Http\Request;
use Carbon\Carbon;


class APIController extends Controller
{

    public function check(AttendanceEmp $request)
    {
        $request->validated();

        if ($employee = Employee::whereEmail(request('email'))->first()) {

            if (Hash::check($request->pin_code, $employee->pin_code)) {




                if (null == Check::whereEmp_id($employee->id)->latest()->first()) {
                    APIController::newAttandance($employee);
                } else {

                    if (Check::whereEmp_id($employee->id)->latest()->first()->leave_time !== null) {
                        APIController::newAttandance($employee);
                    } else {
                        $check = Check::whereEmp_id($employee->id)->latest()->first();
                        $check->leave_time = date("Y-m-d H:i:s");
                        $check->save();
                        return response()->json(['success' => 'Successful in assign the leave'], 200);
                    }

                }

            } else {
                return response()->json(['error' => 'Failed to assign the attendance'], 404);
            }
        }
        return response()->json(['success' => 'Successful in assign the attendance'], 200);
    }


    public function newAttandance($employee)
    {
        $check = new Check;
        $check->emp_id = $employee->id;
        $check->attendance_time = date("Y-m-d H:i:s");
        $check->leave_time = null;
        $check->save();
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



    public function attendance()
    {
        //$request->validated();

        if ($employee = Employee::whereEmail('bushrauroojansari@gmail.com')->first()) {


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
                ;

                $attendance->save();
                return response()->json(['success' => 'Successful in assign the attendance'], 200);
            } else {

                $att = Attendance::whereAttendance_date(date("Y-m-d"))->whereEmp_id($employee->id)->first();

                if ($att->last_time_out == null) {
                    $start = Carbon::parse($att->attendance_time); // Start timestamp
                    $end = Carbon::parse(date("H:i:s")); // End timestamp
                    $work_hours = $start->diff($end);
                    $att->last_time_out = date("H:i:s");
                    $att->work_hours = $work_hours->h.":".$work_hours->m.":".$work_hours->s;
                    $att->save();

                    return response()->json(['error' => 'Time out inserted'], 404);
                } else {
                    if ($att->last_time_out < $att->last_time_in) {
                        $start = Carbon::parse($att->last_time_in); // Start timestamp
                        $end = Carbon::parse(date("H:i:s")); // End timestamp
                        $work_hours = $start->diff($end);
                       

                        $att->last_time_out = date("H:i:s");
                        $att->work_hours = $this->addTimes($att->work_hours,$work_hours->h.":".$work_hours->m.":".$work_hours->s);
                        $att->save();

                        return response()->json(['error' => 'Time out inserted'], 404);


                    }
                    else{
                        $att->last_time_in = date("H:i:s");
                        $att->save();
                        return response()->json(['error' => 'Time in inserted'], 404);

                    }

                }
            }

        }


    }



    public function leave(AttendanceEmp $request)
    {
        $request->validated();

        if ($employee = Employee::whereEmail(request('email'))->first()) {

            if (Hash::check($request->pin_code, $employee->pin_code)) {
                if (!Leave::whereLeave_date(date("Y-m-d"))->whereEmp_id($employee->id)->first()) {
                    $leave = new Leave;
                    $leave->emp_id = $employee->id;
                    $leave->leave_time = date("H:i:s");
                    $leave->leave_date = date("Y-m-d");
                    // ontime + overtime if true , else "early go" ....
                    if ($leave->leave_time >= $employee->schedules->first()->time_out) {
                        LeaveController::overTime($employee);
                    } else {
                        $leave->status = 0;
                    }

                    $leave->save();
                } else {
                    return response()->json(['error' => 'you assigned your leave before'], 404);
                }
            } else {
                return response()->json(['error' => 'Failed to assign the leave'], 404);
            }
        }

        return response()->json(['success' => 'Successful in assign the leave'], 200);
    }

}
