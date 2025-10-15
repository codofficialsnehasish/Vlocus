@extends('layouts.app')

@section('title', 'Run & Idle Report')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Run & Idle Report</div>
    <div class="ps-3">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Run & Idle</li>
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
                        <th>Run Time</th>
                        <th>Idle Time</th>
                        <th>Total Stops</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report['vehicle'] }}</td>
                            <td><span class="badge bg-success">{{ $report['run_time'] }}</span></td>
                            <td><span class="badge bg-warning text-dark">{{ $report['idle_time'] }}</span></td>
                            <td>{{ $report['stops'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
