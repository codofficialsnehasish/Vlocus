@extends('layouts.app')

@section('title')
Edit Offer

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
                    <li class="breadcrumb-item active" aria-current="page">Edit New Offer</li>
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

    <form class="needs-validation" action="{{ route('offer.update') }}" method="post" novalidate enctype="multipart/form-data">
        @csrf
         <input type="hidden" class="form-control" value="{{ old('id',$data->id) }}" name="id" id="id" >
       <!-- <div class="row">-->
       <!--     <div class="col-md-9">-->
       <!--         <div class="card">-->
       <!--             <div class="card-header text-center">Update Offer Details</div>-->
       <!--             <div class="card-body">-->
       <!--                 <div class="mb-3">-->
       <!--                     <label class="form-label" for="name">Name <span class="text-danger">*</span></label>-->
       <!--                     <input type="text" class="form-control" value="{{ old('name',$data->name) }}" name="name" id="name" placeholder="Enter name" required>-->
       <!--                     <div class="valid-feedback">Looks good!</div>-->
       <!--                     <div class="invalid-feedback">Please enter name.</div>-->
       <!--                 </div>-->
                  
       <!--                 <div class="mb-3">-->
       <!--                     <label class="form-label" for="description">Description</label>-->
       <!--                     <textarea name="description" class="form-control" placeholder="Enter Description" id="description">{{ old('description') }}</textarea>-->
       <!--                     <div class="valid-feedback">Looks good!</div>-->
       <!--                     <div class="invalid-feedback">Please enter a valid description.</div>-->
       <!--                 </div>-->
       <!--                    <div class="row">-->
       <!--                 <div class="mb-3 col-md-6">-->
       <!--                     <label for="type" class="form-label">Type <span-->
       <!--                             class="text-danger">*</span></label>-->
       <!--                     <select class="form-select" name="type" id="type" required>-->
       <!--                         <option value="" selected>Select Type</option>-->
                            
       <!--                             <option value="percentage"-->
       <!--                                 {{ old('type') == 'percentage' ? 'selected' : '' }}>-->
       <!--                                 Percentage</option>-->
       <!--                             <option value="flat"-->
       <!--                                 {{ old('type') == 'flat' ? 'selected' : '' }}>-->
       <!--                                 Flat Amount</option>-->
                       

       <!--                     </select>-->
       <!--                     <div class="invalid-feedback">Please select a type.</div>-->
       <!--                 </div>-->
                        
       <!--                  <div class="mb-3 col-md-6">-->
       <!--                     <label class="form-label" for="name">Discount <span class="text-danger">*</span></label>-->
       <!--                     <input type="text" class="form-control" value="{{ old('discount_value') }}" name="discount_value" id="discount_value" placeholder="Enter Discount" required>-->
       <!--                     <div class="valid-feedback">Looks good!</div>-->
       <!--                     <div class="invalid-feedback">Please enter discount.</div>-->
       <!--                 </div>-->
       <!--                  </div>-->
       <!--                  <div class="row">-->
                             
       <!--                     <div class="mb-3 col-md-6">-->
       <!--                         <label class="form-label" for="description">Start Date</label>-->
       <!--                         <input type="date" class="form-control" -->
       <!--value="{{ old('start_date', \Carbon\Carbon::today()->format('Y-m-d')) }}" -->
       <!--name="start_date" id="start_date" required>-->

       <!--                         <div class="valid-feedback">Looks good!</div>-->
       <!--                         <div class="invalid-feedback">Please enter a valid start date.</div>-->
       <!--                     </div>-->
                        
       <!--                       <div class="mb-3 col-md-6">-->
       <!--                         <label class="form-label" for="name">Start Date <span class="text-danger">*</span></label>-->
       <!--                          <input type="date" class="form-control" value="{{ old('end_date') }}" name="end_date" id="end_date" placeholder="Enter End Date" >-->
       <!--                         <div class="valid-feedback">Looks good!</div>-->
       <!--                         <div class="invalid-feedback">Please enter end date.</div>-->
       <!--                     </div>-->
       <!--                 </div>-->
                        
              
       <!--             </div>-->
       <!--         </div>-->
       <!--     </div>-->
       <!--     <div class="col-md-3">-->
       <!--         <div class="row">-->
               
       <!--             <div class="card">-->
       <!--                 <div class="card-header text-center">Offer Image</div>-->
       <!--                 <div class="card-body">-->
       <!--                     <div class="mb-3">-->
       <!--                         <img class="img-thumbnail rounded me-2" id="blah" alt="" width="200"-->
       <!--                             src="" data-holder-rendered="true" style="display: none;">-->

       <!--                     </div>-->
       <!--                     <div class="mb-0">-->
       <!--                         <input type="file" class="form-control" name="image" id="imgInp" required>-->
       <!--                     </div>-->
       <!--                 </div>-->
       <!--             </div>-->
         
       <!--             <div class="card">-->
       <!--                 <div class="card-header text-center">Publish</div>-->
       <!--                 <div class="card-body">-->
       <!--                     <div class="mb-3">-->
       <!--                         <label class="form-label mb-3 d-flex">Status</label>-->
                                <!-- Active -->
       <!--                         <input type="radio" id="statusActive" name="status" class="form-check-input"-->
       <!--                             value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>-->
       <!--                         <label class="form-check-label" for="statusActive">Active</label>-->
                                
                                <!-- Inactive -->
       <!--                         <input type="radio" id="statusInactive" name="status" class="form-check-input"-->
       <!--                             value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>-->
       <!--                         <label class="form-check-label" for="statusInactive">Inactive</label>-->
                                
                                <!-- Expired -->
       <!--                         <input type="radio" id="statusExpired" name="status" class="form-check-input"-->
       <!--                             value="expired" {{ old('status') == 'expired' ? 'checked' : '' }}>-->
       <!--                         <label class="form-check-label" for="statusExpired">Expired</label>-->

       <!--                     </div>-->
       <!--                     <div class="d-md-flex d-grid align-items-center gap-3">-->
       <!--                         <button type="submit" class="btn btn-grd-primary px-4 text-light">Submit</button>-->
       <!--                         <button type="reset" class="btn btn-grd-info px-4 text-light">Reset</button>-->
       <!--                     </div>-->
       <!--                 </div>-->
       <!--             </div>-->
       <!--         </div>-->
       <!--     </div>-->
       <!-- </div>-->
        <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">Update Offer Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{ old('name', $data->name) }}" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter name.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Enter Description">{{ old('description', $data->description) }}</textarea>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter a valid description.</div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-select" name="type" id="type" required>
                                <option value="" disabled>Select Type</option>
                                <option value="percentage" {{ old('type', $data->type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="flat" {{ old('type', $data->type) == 'flat' ? 'selected' : '' }}>Flat Amount</option>
                            </select>
                            <div class="invalid-feedback">Please select a type.</div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="discount_value" class="form-label">Discount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="discount_value" id="discount_value"
                                   value="{{ old('discount_value', $data->discount_value) }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter discount.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                   value="{{ old('start_date', $data->start_date) }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter a valid start date.</div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end_date" id="end_date"
                                   value="{{ old('end_date', $data->end_date) }}" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter end date.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-md-3">
            <div class="row">
                {{-- Image Section --}}
                <div class="card">
                    <div class="card-header text-center">Offer Image</div>
                    <div class="card-body">
                        <div class="mb-3 text-center">
                            @if($data->getFirstMediaUrl('offer-image'))
                                <img src="{{ $data->getFirstMediaUrl('offer-image') }}" id="blah" class="img-thumbnail rounded" width="200">
                            @else
                                <img id="blah" class="img-thumbnail rounded" width="200" style="display: none;">
                            @endif
                        </div>
                        <div class="mb-0">
                            <input type="file" class="form-control" name="image" id="imgInp">
                        </div>
                    </div>
                </div>

                {{-- Status Section --}}
                <div class="card mt-3">
                    <div class="card-header text-center">Publish</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label mb-2 d-block">Status</label>
                            @foreach(['active', 'inactive', 'expired'] as $status)
                                <!--<div class="form-check">-->
                                    <input class="form-check-input" type="radio" name="status" 
                                           id="status_{{ $status }}" value="{{ $status }}"
                                           {{ old('status', $data->status) == $status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_{{ $status }}">{{ ucfirst($status) }}</label>
                                <!--</div>-->
                            @endforeach
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-grd-primary text-light">Submit</button>
                            <button type="reset" class="btn btn-grd-info text-light">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection

