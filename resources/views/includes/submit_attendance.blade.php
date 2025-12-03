
<!-- Add -->
<div class="modal fade" id="att">
    <div class="modal-dialog">
        <div class="modal-content">
			<!-- Log on to bntech.com for more projects! -->
        
            <div class="modal-header">
            <h5 class="modal-title"><b>Submit Attendance</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            
            <div class="modal-body">
			<!-- Log on to bntech.com for more projects! -->

                <div class="card-body text-left">
                    
                    <form method="POST" action="{{ route('attendance') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Pincode</label>
                            <input type="number" class="form-control" placeholder="0000" id="pin" name="pin"
                                required />
                        </div>
                        <input name="latitude" class="latitude" type="hidden" >
                        <input name="longitude" class="longitude" type="hidden">

                        

                        
                        
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-danger waves-effect m-l-5" data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
			<!-- Log on to bntech.com for more projects! -->

        </div>
        
    </div>
</div>
</div>

        