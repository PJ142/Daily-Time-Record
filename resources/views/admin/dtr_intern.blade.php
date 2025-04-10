@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <div class="text-center mb-4">
            <nav class="page-breadcrumb d-inline-block">
                <ol class="breadcrumb justify-content-center mb-2">
                    <li class="breadcrumb-item"><a href="#">Assigned Interns</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Interns Under Supervisors</li>
                </ol>
            </nav>
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('create.users') }}" class="btn btn-primary">Create A New Account</a>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Assigned Interns</h6>
                        <p class="text-muted mb-3">Below are the assigned interns under each supervisor.</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>Supervisor Name</th>
                                        <th>Intern Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Office</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($supervisors as $supervisor)
                                        @foreach ($supervisor->assignedInterns as $assignedIntern)
                                            <tr>
                                                <td>{{ $supervisor->name }}</td>
                                                <td>{{ $assignedIntern->intern->name ?? 'N/A' }}</td>
                                                <td>{{ $assignedIntern->intern->email ?? 'N/A' }}</td>
                                                <td>{{ $assignedIntern->intern->address ?? 'N/A' }}</td>
                                                <td>{{ $assignedIntern->intern->office ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($assignedIntern->intern->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif ($assignedIntern->intern->status == 'inactive')
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-info">View</a>
                                                    <a href="" class="btn btn-sm btn-success">Create</a>
                                                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="" class="btn btn-sm btn-danger delete-btn">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
