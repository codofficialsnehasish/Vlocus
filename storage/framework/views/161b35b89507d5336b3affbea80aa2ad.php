    <?php $__env->startSection('title'); ?> System User <?php $__env->stopSection(); ?>
    
    <?php $__env->startSection('content'); ?>

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">System User</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('dashboard')); ?>">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add New System User</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <a class="btn btn-primary px-4" href="<?php echo e(route('system-user.index')); ?>"><i class="fadeIn animated bx bx-arrow-back"></i>Back</a>
                    </div>
                </div>
            </div>
        <!--end breadcrumb-->

        <form class="needs-validation" action="<?php echo e(route('system-user.store')); ?>" method="post" novalidate enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="card mt-4">
                        <div class="card-header text-center">Basic Information</div>
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">First Name <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter First name" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Last Name <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Enter Last name" name="last_name" value="<?php echo e(old('last_name')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Email <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo e(old('email')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Gender <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control input-height" name="gender" required>
                                        <option value selected disabled>Select...</option>
                                        <option value="male" <?php if(old('gender') == 'male'): ?> selected <?php endif; ?>>Male</option>
                                        <option value="female" <?php if(old('gender') == 'male'): ?> selected <?php endif; ?>>Female</option>
                                        <option value="others" <?php if(old('gender') == 'male'): ?> selected <?php endif; ?>>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Mobile No. <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Alternative Mobile No. <span class="text-danger"></span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="opt_mobile_no" value="<?php echo e(old('opt_mobile_no')); ?>" >
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Date Of Birth  <span class="text-danger"></span></label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Address <span class="text-danger"></span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="address" value="<?php echo e(old('address')); ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Profile Picture</label>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <img class="img-thumbnail rounded me-2" id="blah" alt="" width="200" src="" data-holder-rendered="true" style="display: none;">
                                    </div>
                                    <div class="mb-0">
                                        <input class="form-control" name="profile_image" type="file" id="imgInp">
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Aadhar Card Number <span class="text-danger"></span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="aadhaar_number" value="<?php echo e(old('aadhaar_number')); ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Aadhar Card Image</label>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <img class="img-thumbnail rounded me-2" id="blah2" alt="" width="200" src="" data-holder-rendered="true" style="display: none;">
                                    </div>
                                    <div class="mb-0">
                                        <input class="form-control" name="aadhar_image" type="file" id="imgInp2">
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Pan Card Number <span class="text-danger"></span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="pan_card_number" value="<?php echo e(old('pan_card_number')); ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Pan Card Image</label>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <img class="img-thumbnail rounded me-2" id="blah3" alt="" width="200" src="" data-holder-rendered="true" style="display: none;">
                                    </div>
                                    <div class="mb-0">
                                        <input class="form-control" name="pan_image" type="file" id="imgInp3">
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="card mt-4">
                            <div class="card-header text-center">Account Information</div>
                            <div class="card-body">
                                <div class="row clearfix">
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <label class="col-form-label">Email</label>
                                            <input type="text" id="login-email" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="password" value="<?php echo e(old('password')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <label class="col-form-label">Choose User Role <span class="text-danger">*</span></label>
                                            <select class="form-control input-height" name="roles" required>
                                                <option value selected disabled>Select...</option>
                                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($role->name); ?>" <?php if(old('roles') == $role->name): ?> selected <?php endif; ?>><?php echo e($role->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header text-center">Publish</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label mb-3 d-flex">Status</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline1" name="status" class="form-check-input" value="1" checked>
                                        <label class="form-check-label" for="customRadioInline1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline2" name="status" class="form-check-input" value="0">
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

    <?php $__env->startSection('scripts'); ?>
    <script>
        $('#email').on('keyup',function(){
            $('#login-email').val($(this).val());
        });
    </script>
    <script>
        $('#imgInp2').on('change', function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah2').attr('src', e.target.result).css('display', 'block');
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
        $('#imgInp3').on('change', function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah3').attr('src', e.target.result).css('display', 'block');
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/admin/system_user/create.blade.php ENDPATH**/ ?>