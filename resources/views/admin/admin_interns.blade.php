@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb d-flex justify-content-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><span class="text-primary">Tables</span></li>
                <li class="breadcrumb-item active" aria-current="page">Assign Interns</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">Assign Interns</h4>

                        <!-- Add the Create button here -->
                        <a href="{{ route('assigned.interns') }}" class="btn btn-primary mb-3">Create New Record</a>

                        <div class="accordion " id="supervisorAccordion">
                            @foreach ($supervisors as $supervisor)
                                <div class="accordion-item border shadow-sm mb-3">
                                    <h2 class="accordion-header" id="heading{{ $supervisor->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $supervisor->id }}" aria-expanded="false"
                                            aria-controls="collapse{{ $supervisor->id }}">
                                            {{ $supervisor->name }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $supervisor->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $supervisor->id }}"
                                        data-bs-parent="#supervisorAccordion">
                                        <div class="accordion-body">
                                            <table class="table table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Intern Name</th>
                                                        <th>Internship Start Date</th>
                                                        <th>Internship End Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($supervisor->assignedInterns as $record)
                                                        <tr>
                                                            <td>{{ $record->intern->name }}</td>
                                                            <td>{{ $record->internship_start_date }}</td>
                                                            <td>{{ $record->internship_end_date }}</td>
                                                            <td>
                                                                <a href="{{ route('edit.assigned.interns', $record->id) }}"
                                                                    class="btn btn-sm btn-warning">Edit</a>
                                                                <a href="{{ route('delete.assigned.interns', $record->id) }}"
                                                                    class="btn btn-sm btn-danger delete-btn">Delete</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
