@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <div class="text-center mb-4">
            <nav class="page-breadcrumb d-inline-block">
                <ol class="breadcrumb justify-content-center mb-2">
                    <li class="breadcrumb-item"><a href="#">DTR</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Intern DTR Records</li>
                </ol>
            </nav>
            <h5 class="mt-2">
                DTR Entries for {{ $assigned->intern->name }}
            </h5>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Daily Time Records</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>Date</th>
                                        <th>Time In (AM)</th>
                                        <th>Time Out (AM)</th>
                                        <th>Time In (PM)</th>
                                        <th>Time Out (PM)</th>
                                        <th>Total Hours</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($dtrs as $dtr)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($dtr->date)->format('F d, Y') }}</td>
                                            <td>{{ $dtr->time_in_am ?? '-' }}</td>
                                            <td>{{ $dtr->time_out_am ?? '-' }}</td>
                                            <td>{{ $dtr->time_in_pm ?? '-' }}</td>
                                            <td>{{ $dtr->time_out_pm ?? '-' }}</td>
                                            <td>{{ $dtr->total_hours_display }}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="" class="btn btn-sm btn-danger delete-btn">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No DTR records found.</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
