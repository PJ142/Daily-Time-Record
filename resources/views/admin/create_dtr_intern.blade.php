@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="row profile-body justify-content-center">
            <div class="col-md-8 col-xl-5 middle-wrapper">
                <div class="row">
                    <div class="card-body">
                        <h6 class="card-title">Create DTR Entry</h6>

                        <form method="POST" action="{{ route('store.dtr.intern') }}" class="forms-sample">
                            @csrf

                            {{-- Hidden input so the selected intern ID gets submitted --}}
                            <input type="hidden" name="assigned_intern_id" value="{{ $selectedAssignedInternId }}">

                            <select name="assigned_intern_id" class="form-control" required disabled>
                                <option value="">Select Assigned Intern</option>
                                @foreach ($assignedInterns as $assigned)
                                    <option value="{{ $assigned->id }}"
                                        {{ isset($selectedAssignedInternId) && $selectedAssignedInternId == $assigned->id ? 'selected' : '' }}>
                                        {{ $assigned->intern->name }} (Supervisor: {{ $assigned->supervisor->name }})
                                    </option>
                                @endforeach
                            </select>

                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control"
                                    value="{{ now()->format('Y-m-d') }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Time In (AM)</label>
                                <input type="time" name="time_in_am" id="time_in_am" class="form-control" min="08:00"
                                    max="12:00">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Time Out (AM)</label>
                                <input type="time" name="time_out_am" id="time_out_am" class="form-control"
                                    max="12:00">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Time In (PM)</label>
                                <input type="time" name="time_in_pm" id="time_in_pm" class="form-control" min="13:00">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Time Out (PM)</label>
                                <input type="time" name="time_out_pm" id="time_out_pm" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Save DTR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Optional styling for dark mode --}}
    <style>
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(100%);
        }

        input[type="date"],
        input[type="time"] {
            color: #fff;
        }
    </style>

    {{-- Link to your custom JS validation --}}
    <script src="{{ asset('backend/assets/js/dtr-validation.js') }}"></script>
@endsection
