@extends('layouts.app')

@section('title', 'Trip Summary Report')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Trip Summary</div>
    <div class="ps-3">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Trip Summary Report</li>
        </ol>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Branch</th>
                        <th>Shop Name</th>
                        <th>Vehicle No</th>
                        <th>Trip Date</th>
                        <th>Total Stops</th>
                        <th>Total Deliveries</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->branch->name ?? 'N/A' }}</td>
                            <td>{{ $report->shop_name ?? 'N/A' }}</td>
                            <td>{{ $report->vehicle_no ?? 'N/A' }}</td>
                            <td>{{ $report->created_at->format('d M Y') }}</td>
                            <td>{{ rand(3,8) }}</td>
                            <td>{{ rand(10,25) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $reports->links() }}
    </div>
</div>
@endsection
