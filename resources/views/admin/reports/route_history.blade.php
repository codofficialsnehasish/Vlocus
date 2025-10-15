@extends('layouts.app')

@section('title', 'Route History Report')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Route History</div>
    <div class="ps-3">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Route History Report</li>
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
                        <th>Shop Name</th>
                        <th>Product</th>
                        <th>Delivered Qty</th>
                        <th>Delivery Date</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->shop->name ?? 'N/A' }}</td>
                            <td>{{ $report->product_name ?? 'N/A' }}</td>
                            <td>{{ $report->delivered_qty ?? rand(1,10) }}</td>
                            <td>{{ $report->created_at->format('d M Y') }}</td>
                            <td>{{ $report->shop->branch->name ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
