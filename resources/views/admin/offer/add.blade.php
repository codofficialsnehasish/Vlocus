@extends('layouts.app')

@section('title')
Create Offer

@endsection

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Offer</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Offer</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <a class="btn btn-primary px-4" href="{{ route('offer.index') }}"><i
                        class="fadeIn animated bx bx-arrow-back"></i>Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <form class="needs-validation" action="{{ route('offer.store') }}" method="post" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-center">Add Offer Details</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Enter name" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter name.</div>
                        </div>
                  
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Description" id="description">{{ old('description') }}</textarea>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter a valid description.</div>
                        </div>
                           <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="type" class="form-label">Type <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="type" id="type" required>
                                <option value="" selected>Select Type</option>
                            
                                    <option value="percentage"
                                        {{ old('type') == 'percentage' ? 'selected' : '' }}>
                                        Percentage</option>
                                    <option value="flat"
                                        {{ old('type') == 'flat' ? 'selected' : '' }}>
                                        Flat Amount</option>
                       

                            </select>
                            <div class="invalid-feedback">Please select a type.</div>
                        </div>
                        
                         <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">Discount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('discount_value') }}" name="discount_value" id="discount_value" placeholder="Enter Discount" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter discount.</div>
                        </div>
                         </div>
                         <div class="row">
                             
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="description">Start Date</label>
                                <input type="date" class="form-control" 
       value="{{ old('start_date', \Carbon\Carbon::today()->format('Y-m-d')) }}" 
       name="start_date" id="start_date" required>

                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter a valid start date.</div>
                            </div>
                        
                              <div class="mb-3 col-md-6">
                                <label class="form-label" for="name">Start Date <span class="text-danger">*</span></label>
                                 <input type="date" class="form-control" value="{{ old('end_date') }}" name="end_date" id="end_date" placeholder="Enter End Date" >
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter end date.</div>
                            </div>
                        </div>
                        
              
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
               
                    <div class="card">
                        <div class="card-header text-center">Offer Image</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <img class="img-thumbnail rounded me-2" id="blah" alt="" width="200"
                                    src="" data-holder-rendered="true" style="display: none;">

                            </div>
                            <div class="mb-0">
                                <input type="file" class="form-control" name="image" id="imgInp" required>
                            </div>
                        </div>
                    </div>
         
                    <div class="card">
                        <div class="card-header text-center">Publish</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label mb-3 d-flex">Status</label>
                                <!-- Active -->
                                <input type="radio" id="statusActive" name="status" class="form-check-input"
                                    value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusActive">Active</label>
                                
                                <!-- Inactive -->
                                <input type="radio" id="statusInactive" name="status" class="form-check-input"
                                    value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusInactive">Inactive</label>
                                
                                <!-- Expired -->
                                <input type="radio" id="statusExpired" name="status" class="form-check-input"
                                    value="expired" {{ old('status') == 'expired' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusExpired">Expired</label>

                            </div>
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-grd-primary px-4 text-light">Submit</button>
                                <button type="reset" class="btn btn-grd-info px-4 text-light">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

