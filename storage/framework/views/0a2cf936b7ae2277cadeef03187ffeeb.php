<?php $__env->startSection('title'); ?>
Create Vehicle Type

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vehicle Type</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Vehicle Type</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <a class="btn btn-primary px-4" href="<?php echo e(route('vehicle-type.index')); ?>"><i
                        class="fadeIn animated bx bx-arrow-back"></i>Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <form class="needs-validation" action="<?php echo e(route('vehicle-type.store')); ?>" method="post" novalidate enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-center">Add Vehicle Type Details</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name" id="name" placeholder="Enter name" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter name.</div>
                        </div>
                  
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Description" id="description"><?php echo e(old('description')); ?></textarea>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter a valid description.</div>
                        </div>
              
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
               
                    <div class="card">
                        <div class="card-header text-center">Vehicle Icon</div>
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
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadioInline1" name="is_visible" class="form-check-input"
                                        value="1" checked>
                                    <label class="form-check-label" for="customRadioInline1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadioInline2" name="is_visible" class="form-check-input"
                                        value="0">
                                    <label class="form-check-label" for="customRadioInline2">Inactive</label>
                                </div>
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/admin/vehicle_type/add.blade.php ENDPATH**/ ?>