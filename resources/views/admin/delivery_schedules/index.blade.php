@extends('layouts.app')

@section('title') Delivery Schedule @endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Delivery Schedule</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Delivery Schedule</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            {{-- @can('Delivery Schedule Create') --}}
            @role(['Employee'])
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a class="btn btn-primary px-4" href="{{ route('delivery-schedule.create') }}"><i class="bi bi-plus-lg me-2"></i>Add New</a>
                </div>
            @endrole
            {{-- @endcan --}}
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Bulk Upload Delivery Schedule</h5>
            <a href="{{ route('delivery-schedule.template.download') }}" class="btn btn-sm btn-success">
                <i class="bi bi-download"></i> Download Template
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('delivery-schedule.bulk.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <input type="file" name="bulk_file" class="form-control" required>
                    </div>
                    <div class="col-md-4 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload"></i> Upload File
                        </button>
                    </div>
                </div>
            </form>

            <!-- Instruction Section -->
            <hr>
            <div class="alert alert-info mt-3">
                <h6 class="mb-2"><i class="bi bi-info-circle"></i> Instructions for Filling the Excel Template:</h6>
                <ul class="mb-0 ps-3">
                    <li>Enter the <strong>Delivery Date</strong> in <code>YYYY-MM-DD</code> format (e.g., <code>2025-11-10</code>).</li>
                    <li>Enter valid <strong>Driver</strong> Mobile Number.</li>
                    <li>Enter valid <strong>Vehicle</strong> Number.</li>
                    <li>Enter valid <strong>Shop</strong> number where the delivery is scheduled.</li>
                    <li><strong>Branch/Consignor</strong> will be auto-assigned based on your login (Employee or Branch user).</li>
                    <li class="text-danger">Do not rename, remove, or reorder any columns in the Excel sheet.</li>
                    <li class="text-danger">Once filled, save the file and upload it here in <strong>.xlsx</strong> format only.</li>
                </ul>
            </div>
        </div>
    </div>



    <div class="card mt-4">
        <div class="card-body">
            <div class="product-table">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.l</th>
                                <th>Delevery Date</th>
                                <th>Order Id</th>
                                <th>Driver</th>
                                <th>Vehicle</th>
                                <th>Total Shop</th>
                                <th>Status</th>
                                @canany(['Delivery Schedule Edit', 'Delivery Schedule Delete'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @if ($delivery_schedules->isNotEmpty())
                                @foreach ($delivery_schedules as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->delivery_date }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->driver?->name }}</td>
                                    <td>{{ $item->vehicle?->vehicle_number }}</td>
                                    <td>{{ $item->deliveryScheduleShops?->count() }}</td>
                                    <td>
                                        @if($item->is_completed)
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>

                                    @canany(['Delivery Schedule Edit', 'Delivery Schedule Delete'])
                                        <td class="d-flex">
                                            {{-- @can('Delivery Schedule Edit') --}}
                                            @role(['Employee'])
                                                <a class="btn" href="{{ route('delivery-schedule.edit', $item->id) }}" alt="edit"><i
                                                        class="text-primary" data-feather="edit"></i></a>
                                            @endrole
                                            {{-- <a class="btn" href="{{ route('delivery-schedule.show', $item->id) }}" alt="edit"><i class="text-primary" data-feather="eye"></i></a> --}}
                                            <a class="btn" href="{{ route('track.delivery', ['delivery_id' => $item->id]) }}" alt="edit"><i class="text-primary" data-feather="eye"></i></a>
                                            {{-- <a class="btn" href="{{ route('delivery.invoice', $item->id) }}" alt="invoice"><i data-feather="file-text"></i></a> --}}
                                            {{-- @can('Delivery Schedule Delete') --}}
                                            @role(['Employee'])
                                                <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                    data-url="{{ route('delivery-schedule.destroy',$item->id) }}" data-item="Delivery Schedule"
                                                    alt="delete"><i
                                                    class="text-danger" data-feather="trash-2"></i></a>
                                            @endrole
                                        </td>
                                    @endcanany
                                </tr>
                                @endforeach
                            @endif
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
