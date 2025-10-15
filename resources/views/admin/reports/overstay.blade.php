@extends('layouts.app')

@section('title', 'Overstay Report')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Overstay Report</div>
    <div class="ps-3">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Overstay</li>
        </ol>
    </div>
</div>
<!--end breadcrumb-->

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Vehicle Number</th>
                        <th>Location</th>
                        <th>Allowed Time</th>
                        <th>Actual Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report['vehicle'] }}</td>
                            <td>{{ $report['location'] }}</td>
                            <td><span class="badge bg-primary">{{ $report['allowed_time'] }}</span></td>
                            <td><span class="badge bg-danger">{{ $report['actual_time'] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
