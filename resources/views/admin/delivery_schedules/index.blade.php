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

    <div class="card mt-4">
        <div class="card-body">
            <div class="product-table">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.l</th>
                                <th>Delevery Date</th>
                                <th>Driver</th>
                                <th>Vehicle</th>
                                <th>Total Shop</th>
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
                                    <td>{{ $item->driver?->name }}</td>
                                    <td>{{ $item->vehicle?->name }}</td>
                                    <td>{{ $item->deliveryScheduleShops?->count() }}</td>

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
