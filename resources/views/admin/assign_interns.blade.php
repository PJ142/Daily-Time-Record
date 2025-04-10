@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="row profile-body justify-content-center">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-5 middle-wrapper">
                <div class="row">
                    <div class="card-body">

                        <h6 class="card-title">Assign Interns to a Supervisor</h6>

                        <form method="POST" action="{{ route('store.assigned.interns') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Supervisor Name</label>
                                <select name="supervisor_id" class="form-control" required>
                                    <option value="">Select Supervisor</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Intern Name</label>
                                <select name="intern_id" class="form-control" required>
                                    <option value="">Select Intern</option>
                                    @foreach ($interns as $intern)
                                        <option value="{{ $intern->id }}">{{ $intern->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Internship Start Date</label>
                                <input type="date" name="internship_start_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Internship End Date</label>
                                <input type="date" name="internship_end_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Hours</label>
                                <input type="number" name="total_hours" class="form-control" required min="1">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(100%);
        }

        input[type="date"] {
            color: #fff;
        }
    </style>
@endsection
