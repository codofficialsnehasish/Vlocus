@extends('layouts.app')

@section('title') Shop @endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Shop</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            @can('Shop Create')
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a class="btn btn-primary px-4" href="{{ route('shop.create') }}"><i class="bi bi-plus-lg me-2"></i>Add New</a>
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
                                <th>S.l</th>
                                <th>Shop Number</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Address</th>
                                <th>Contact Person</th>
                                <th>Contact Number</th>
                                <th>Location Coordinates</th>
                                <th>Status</th>
                                @canany(['Shop Edit', 'Shop Delete'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @if ($shops->isNotEmpty())
                                @foreach ($shops as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                     <td>{{ $item->shop_number }}</td>
                                    <td>{{ $item->shop_name }}</td>
                                    <td><img src="{{ $item->getFirstMediaUrl('shop-image') }}" alt="" width="50"></td>
                                    <td>{{ $item->shop_address }}</td>
                                    <td>{{ $item->shop_contact_person_name }}</td>
                                    <td>{{ $item->shop_contact_person_phone }}</td>
                                    <td>{{ $item->shop_latitude }}, {{ $item->shop_longitude }}</td>
                                    <td>{!! check_status($item->is_visible) !!}</td>

                                    @canany(['Shop Edit', 'Shop Delete'])
                                        <td class="d-flex">
                                            @can('Shop Edit')
                                                <a class="btn" href="{{ route('shop.edit', $item->id) }}" alt="edit"><i
                                                        class="text-primary" data-feather="edit"></i></a>
                                            @endcan
                                            @can('Shop Delete')
                                                <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                    data-url="{{ route('shop.destroy',$item->id) }}" data-item="Shop"
                                                    alt="delete"><i
                                                    class="text-danger" data-feather="trash-2"></i></a>
                                            @endcan
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
