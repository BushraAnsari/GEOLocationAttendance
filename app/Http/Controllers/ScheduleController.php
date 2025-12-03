<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\ScheduleEmp;

class ScheduleController extends Controller
{
   
    public function index()
    {
     
        return view('admin.schedule')->with('schedules', Schedule::all());
        flash()->success('Success','Schedule has been created successfully !');

    }


    public function store(ScheduleEmp $request)
    {
        $request->validated();
        
        $schedule = new schedule;
        $schedule->slug = $request->slug;
        $schedule->time_in = $request->time_in;
        $schedule->work_hours = $request->work_hours;
        $schedule->latitude = $request->latitude;
        $schedule->longitude = $request->longitude;
        $schedule->radius = $request->radius;
        $schedule->save();



        
        flash()->success('Success','Schedule has been created successfully !');
        return redirect()->route('schedule.index');

    }

    public function update(Schedule $schedule,ScheduleEmp $request)
    {
      
        $request['time_in'] = str_split($request->time_in, 5)[0];

        $request->validated();

        $schedule->slug = $request->slug;
        $schedule->time_in = $request->time_in;
        $schedule->work_hours = $request->work_hours;
        $schedule->latitude = $request->latitude;
        $schedule->longitude = $request->longitude;
        $schedule->radius = $request->radius;
        

        

        
        $schedule->save();
        flash()->success('Success','Schedule has been Updated successfully !');
        return redirect()->route('schedule.index');


    }

  
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        flash()->success('Success','Schedule has been deleted successfully !');
        return redirect()->route('schedule.index');
    }
}
