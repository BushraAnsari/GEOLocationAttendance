<!-- Edit -->
<div class="modal fade" id="edit{{ $schedule->slug }}">
    <div class=" modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Edit Schedule</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <strong>Current Location</strong>Latitude<p class="latitude"></p>Longitude<p class="longitude"></p></p>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('schedule.update', $schedule->slug) }}" novalidate>
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                 
                    <input type="hidden" name="force_update" value="{{ now() }}">

                    <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Name <i>{without any space}</i></label>


                        <div class="bootstrap-timepicker">
                            <input type="text" class="form-control" id="name" name="slug"
                                value="{{ $schedule->slug }}" required>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="edit_time_in" class="col-sm-3 control-label">Time In</label>


                        <div class="bootstrap-timepicker">
                            <input type="time" class="form-control timepicker" id="edit_time_in" name="time_in"
                                value="{{$schedule->time_in}}" required>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="edit_work_hours" class="col-sm-3 control-label">Work Hours</label>


                        <div class="bootstrap-timepicker">
                            <input type="number" class="form-control" id="edit_work_hours" name="work_hours"
                                value="{{ $schedule->work_hours }}" required>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="latitude" class="col-sm-3 control-label">Latitude</label>
                        <input type="text" name="latitude" id="latitudes" class="form-control lat"
                            value="{{ $schedule->latitude }}" required>
                    </div>

                    <div class="form-group">
                        <label for="longitude" class="col-sm-3 control-label">Longitude</label>
                        <input type="text" name="longitude" id="longitudes" class="form-control"
                            value="{{ $schedule->longitude }}" required>
                    </div>

                    <div class="form-group">
                        <label for="radius" class="col-sm-3 control-label">Radius (km)</label>
                        <input type="number" name="radius" id="radius" class="form-control" step="0.01"
                            value="{{ $schedule->radius }}" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check-square-o"></i>
                    Update</button>
                </form>
            </div>
        </div>
       
    </div>


</div>

<!-- Delete -->
<div class="modal fade" id="delete{{ $schedule->slug }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">

                <h4 class="modal-title "><span class="employee_id">Delete Schedule</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('schedule.destroy', $schedule->slug) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6>Are you sure you want to delete:</h6>
                        <h2 class="bold del_employee_name">{{ $schedule->slug }}</h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
   


</div>
