@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="row profile-body justify-content-center">
            <div class="col-md-8 col-xl-4 middle-wrapper">
                <div class="row">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <h4 class="card-title mb-2">Edit Assigned Intern</h4>

                        <form method="POST" action="{{ route('update.assigned.interns', $assignintern->id) }}"
                            class="forms-sample">
                            @csrf
                            @method('PUT')

                            <!-- Intern Name Input -->
                            <div class="mb-3">
                                <label class="form-label">Intern Name</label>
                                <input type="text" name="intern_name" value="{{ $assignintern->intern->name }}"
                                    class="form-control">
                            </div>

                            <!-- Supervisor Name Dropdown -->
                            <select name="supervisor_id" class="form-control" required>
                                <option value="">Select Supervisor</option>
                                @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}"
                                        {{ $assignintern->supervisor_id == $supervisor->id ? 'selected' : '' }}>
                                        {{ $supervisor->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Internship Start Date -->
                            <div class="mb-3">
                                <label class="form-label">Internship Start Date</label>
                                <input type="date" name="internship_start_date"
                                    value="{{ $assignintern->internship_start_date }}" class="form-control" required>
                            </div>

                            <!-- Internship End Date -->
                            <div class="mb-3">
                                <label class="form-label">Internship End Date</label>
                                <input type="date" name="internship_end_date"
                                    value="{{ $assignintern->internship_end_date }}" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
