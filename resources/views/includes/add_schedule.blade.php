<!-- Add -->


<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"><b>Set a New Schedule</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
              
            </div>
            <!-- Log on to bntech.com for more projects! -->
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('schedule.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name"  class="col-sm-6 control-label">Name <i>{without any space}</i></label>

                        
                            <div class="bootstrap-timepicker">
                                <input type="text" placeholder="Enter a Schedule name [hypen accepted]" class="form-control timepicker" id="name" name="slug">
                            </div>
                        <!-- Log on to bntech.com for more projects! -->
                    </div>
                    <div class="form-group">
                        <label for="time_in" class="col-sm-3 control-label">Time In</label>

                        
                            <div class="bootstrap-timepicker">
                                <input type="time" class="form-control timepicker" id="time_in" name="time_in" required>
                            </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="work_hours" class="col-sm-3 control-label">Work Hours</label>

                        
                            <div class="bootstrap-timepicker">
                                <input type="number" class="form-control" id="work_hours" name="work_hours" required>
                            </div>
                        <!-- Log on to bntech.com for more projects! -->
                    </div>
                    
                    <div class="form-group">
                        <label for="latitude" class="col-sm-3 control-label" >Latitude</label>
                        <input type="text" name="latitude" id="latitud" class="form-control latitude" >
                    </div>
                
                    <div class="form-group">
                        <label for="longitude" class="col-sm-3 control-label">Longitude</label>
                        <input type="text" name="longitude" id="longitud" class="form-control longitude" >
                    </div>
                
                    <div class="form-group">
                        <label for="radius" class="col-sm-3 control-label">Radius (km)</label>
                        <input type="number" name="radius" id="radius" class="form-control" step="0.01">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


