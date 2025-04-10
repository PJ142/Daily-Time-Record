@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <div class="text-center mb-4">
            <nav class="page-breadcrumb d-inline-block">
                <ol class="breadcrumb justify-content-center mb-2">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Table</li>
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
                        <h6 class="card-title">Data Table</h6>
                        <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official
                                DataTables Documentation </a>for a full list of instructions and other options.</p>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Office</th>
                                        <th>Role</th>
                                        <th>Supervisor</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address ?? 'N/A' }}</td>
                                            <td>{{ $user->office ?? 'N/A' }}</td>
                                            <td>
                                                @if ($user->role === 'supervisor')
                                                    <span class="badge bg-success">Supervisor</span>
                                                @elseif ($user->role === 'intern')
                                                    <span class="badge bg-info text-dark">Intern</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->role === 'intern')
                                                    @php
                                                        $assigned = $assignedinterns->firstWhere(
                                                            'intern_id',
                                                            $user->id,
                                                        );
                                                    @endphp
                                                    {{ $assigned?->supervisor?->name ?? 'Unassigned' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif ($user->status == 'inactive')
                                                    <span class="badge bg-danger">Inactive</span>
                                                @else
                                                    <span class="badge bg-secondary">Unknown</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.user.details', $user->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{ route('delete.user.details', $user->id) }}"
                                                    class="btn btn-sm btn-danger delete-btn">Delete</a>
                                            </td>
                                        </tr>
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
