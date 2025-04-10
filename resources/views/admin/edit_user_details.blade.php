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

                        <h4 class="card-title mb-2">Edit User Details</h4>

                        <form method="POST" action="{{ route('update.user.details', $users->id) }}" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $users->name }}" class="form-control"
                                    required>
                            </div>

                            <!-- Username Input -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" value="{{ $users->username }}" class="form-control">
                            </div>

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $users->email }}" class="form-control"
                                    required>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>

                            <!-- Office Input -->
                            <div class="mb-3">
                                <label for="office" class="form-label">Office</label>
                                <input type="text" name="office" value="{{ $users->office }}" class="form-control">
                            </div>

                            <!-- Role Input -->
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control">
                                    <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="supervisor" {{ $users->role == 'supervisor' ? 'selected' : '' }}>
                                        Supervisor</option>
                                    <option value="intern" {{ $users->role == 'intern' ? 'selected' : '' }}>Intern</option>
                                </select>
                            </div>

                            <!-- Status Input -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ $users->status == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ $users->status == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
