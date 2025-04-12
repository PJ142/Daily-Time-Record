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

                        <h4 class="card-title mb-2">Edit Daily Time Record</h4>

                        <form method="POST" action="{{ route('update.dtr.intern', $dtr->id) }}" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <!-- Date -->
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ $dtr->date }}"
                                    required>
                            </div>

                            <!-- Time In AM -->
                            <div class="mb-3">
                                <label class="form-label">Time In (AM)</label>
                                <input type="time" name="time_in_am" class="form-control" value="{{ $dtr->time_in_am }}"
                                    required>
                            </div>

                            <!-- Time Out AM -->
                            <div class="mb-3">
                                <label class="form-label">Time Out (AM)</label>
                                <input type="time" name="time_out_am" class="form-control"
                                    value="{{ $dtr->time_out_am }}" required>
                            </div>

                            <!-- Time In PM -->
                            <div class="mb-3">
                                <label class="form-label">Time In (PM)</label>
                                <input type="time" name="time_in_pm" class="form-control" value="{{ $dtr->time_in_pm }}"
                                    required>
                            </div>

                            <!-- Time Out PM -->
                            <div class="mb-3">
                                <label class="form-label">Time Out (PM)</label>
                                <input type="time" name="time_out_pm" class="form-control"
                                    value="{{ $dtr->time_out_pm }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
