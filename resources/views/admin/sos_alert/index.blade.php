@extends('layouts.app')

@section('title')
    SOS Alrets
@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">SOS Alrets</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">SOS Alrets</li>
                </ol>
            </nav>
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
                                <th>Driver</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
              
                                @canany(['Brand Edit', 'Brand Delete'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sos_alerts->isNotEmpty())
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($sos_alerts as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->driver->name }}</td>
                                        <td>{{ $item->driver->phone  }}</td>
                                        <td>{{ $item->message }}</td>
                                        <td>{{ $item->latitude  }}</td>
                                        <td>{{ $item->longitude  }}</td>


                            
                                        @canany(['Brand Edit', 'Brand Delete'])
                                            <td class="d-flex">
                                                @can('Brand Edit')
                                                    <a class="btn" href="{{ route('brand.edit', $item->id) }}" alt="edit"><i
                                                            class="text-primary" data-feather="edit"></i></a>
                                                @endcan
                                                @can('Brand Delete')
                                                    <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                        data-url="{{ route('sos_alert.delete', $item->id) }}" data-item="SOS Alert"
                                                        alt="delete"><i class="text-danger" data-feather="trash-2"></i></a>
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
