@extends('layouts.app')

@section('title')
    Vehicle
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vehicle</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vehicle</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            @can('Vehicle Create')
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a class="btn btn-primary px-4" href="{{ route('vehicle.create') }}"><i class="bi bi-plus-lg me-2"></i>Add
                        New Vehicle</a>
                </div>
            @endcan
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
                                <th>Name</th>
                                <th>Vehicle Number</th>


                                <th>Image</th>
                                <th>Visiblity</th>
                                @canany(['Vehicle Edit', 'Vehicle Delete'])
                                <th>Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $item)
                                <tr>
                                    <td>
                                        <a href="{{route('vehicle.journey',$item->id)}}">{{ $item->name }}</a>
                                        
                                    </td>
                                    <td>{{ $item->vehicle_number }}</td>
    
                                    
                                    <td><img src="{{ $item->getFirstMediaUrl('vehicles') }}" alt="" width="50"></td>
                                    <td>{!! check_status($item->is_visible) !!}</td>
                                    @canany(['Vehicle Edit', 'Vehicle Delete'])
                                        <td class="d-flex">
                                            @can('Vehicle Edit')
                                                <a class="btn" href="{{ route('vehicle.edit', $item->id) }}" alt="edit"><i
                                                        class="text-primary" data-feather="edit"></i></a>
                                            @endcan
                                            @can('Vehicle Delete')
                                                <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                    data-url="{{ route('vehicle.delete', $item->id) }}" data-item="Route"
                                                    alt="delete"><i class="text-danger" data-feather="trash-2"></i></a>
                                            @endcan
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
