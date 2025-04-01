@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><span class="text-primary">Tables</span></li>
                <li class="breadcrumb-item active" aria-current="page">Daily Time Records</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">DAILY TIME RECORDS </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Intern Name</th>
                                        <th>Internship Start Date</th>
                                        <th>Internship End Date</th>
                                        <th>Supervisor Name</th>
                                        <th>Date</th>
                                        <th>Time In AM</th>
                                        <th>Time Out AM</th>
                                        <th>Time In PM</th>
                                        <th>Time Out PM</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dtr as $record)
                                        <tr>
                                            <td>{{ $record->intern->name }}</td>
                                            <td>{{ $record->internship_start_date }}</td>
                                            <td>{{ $record->internship_end_date }}</td>
                                            <td>{{ $record->supervisor->name }}</td>
                                            <td>{{ $record->date }}</td>
                                            <td>{{ $record->time_in_am }}</td>
                                            <td>{{ $record->time_out_am }}</td>
                                            <td>{{ $record->time_in_pm }}</td>
                                            <td>{{ $record->time_out_pm }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
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
