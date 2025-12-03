<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
			<!-- Log on to bntech.com for more projects! -->
        
            <div class="modal-header">
            <h5 class="modal-title"><b>Add New Employee</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            
            <div class="modal-body">
			<!-- Log on to bntech.com for more projects! -->

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf
                    
                        <!-- Display all validation errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name">Name <i>{without any space}</i></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Enter an Employee name [hyphen accepted]" id="name" name="name"
                                   value="{{ old('name') }}" required />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <!-- Position Field -->
                        <div class="form-group">
                            <label for="position">Position <i></i></label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                   placeholder="Enter Employee's Position" id="position" name="position"
                                   value="{{ old('position') }}" required />
                            @error('position')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <!-- Schedule Field -->
                        <div class="form-group">
                            <label for="schedule">Schedule</label>
                            <select class="form-control @error('schedule') is-invalid @enderror" 
                                    id="schedule" name="schedule" required>
                                <option value="" selected>- Select -</option>
                                @foreach($schedules as $schedule)
                                    <option value="{{ $schedule->slug }}" 
                                        {{ old('schedule') == $schedule->slug ? 'selected' : '' }}>
                                        {{ $schedule->slug }} -> from {{ $schedule->time_in }}
                                        work hrs {{ $schedule->work_hours }}
                                    </option>
                                @endforeach
                            </select>
                            @error('schedule')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <!-- Buttons -->
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
@if ($errors->any())

@section('script')


<script>
$("#addnew").modal('show');
</script>

<!-- Responsive-table-->

@endsection
@endif