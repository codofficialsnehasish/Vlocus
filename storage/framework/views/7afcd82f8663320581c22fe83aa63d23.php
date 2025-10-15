<?php $__env->startSection('title'); ?>
    Branch
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Branch</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Branch</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Branch Create')): ?>
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a class="btn btn-primary px-4" href="<?php echo e(route('branch.index')); ?>"><i
                            class="fadeIn animated bx bx-arrow-back"></i>Back</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!--end breadcrumb-->

    <form class="needs-validation" action="<?php echo e(route('branch.store')); ?>" method="post" novalidate enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-9">
                <div class="card mt-4">
                    <div class="card-header text-center">Basic Information</div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Branch Name <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Enter Branch name" name="company_name"
                                    value="<?php echo e(old('company_name')); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" id="email"
                                    value="<?php echo e(old('email')); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Mobile No. <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Alternative Mobile No. <span
                                    class="text-danger"></span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="opt_mobile_no"
                                    value="<?php echo e(old('opt_mobile_no')); ?>">
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
                                    <img class="img-thumbnail rounded me-2" id="blah" alt="" width="200"
                                        src="" data-holder-rendered="true" style="display: none;">
                                </div>
                                <div class="mb-0">
                                    <input class="form-control" name="profile_image" type="file" id="imgInp">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Pan Card Number <span
                                    class="text-danger"></span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pan_card_number"
                                    value="<?php echo e(old('pan_card_number')); ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Pan Card Image</label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <img class="img-thumbnail rounded me-2" id="blah3" alt="" width="200"
                                        src="" data-holder-rendered="true" style="display: none;">
                                </div>
                                <div class="mb-0">
                                    <input class="form-control" name="pan_image" type="file" id="imgInp3">
                                </div>
                            </div>
                        </div>



                        

                        

                  

                        
                        <div class="row">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Branch Latitude <span class="text-danger"></span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="latitude" value="<?php echo e(old('latitude')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Branch Longitude <span class="text-danger"></span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="longitude" value="<?php echo e(old('longitude')); ?>" required>
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
                                        <input type="text" id="login-email" class="form-control"
                                            value="<?php echo e(old('email')); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="password"
                                            value="<?php echo e(old('password')); ?>" required>
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
                                    <input type="radio" id="customRadioInline1" name="status"
                                        class="form-check-input" value="1" checked>
                                    <label class="form-check-label" for="customRadioInline1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadioInline2" name="status"
                                        class="form-check-input" value="0">
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
       <div class="modal fade" id="quickCompanyAddModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 bg-grd-primary py-2">
                    <h5 class="modal-title text-light">Company Add Form</h5>
                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                        <i class="material-icons-outlined text-light">close</i>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="card w-100">
                            <form action="" id="companyCreateForm" class="needs-validation" novalidate>
                                <?php echo csrf_field(); ?>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Company Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Name"
                                            name="company_name" value="<?php echo e(old('company_name')); ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter company name.</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="description">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                value="<?php echo e(old('email')); ?>"placeholder="Enter Email" required>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid email.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="phone">Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="<?php echo e(old('phone')); ?>"
                                                name="phone" id="phone" placeholder="Enter phone" required>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter phone.</div>
                                        </div>
                                    </div>

                                    <div class="row">



                                        <div class="col-md-6">
                                            <label class="form-label" for="trade_license">Registrations Number <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                value="<?php echo e(old('trade_license')); ?>" name="trade_license"
                                                id="trade_license" placeholder="Enter trade_license" required>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter trade license.</div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Password <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="password"
                                                        id="generated-password" value="<?php echo e(old('password')); ?>" required>
                                                    <button type="button" class="btn btn-secondary"
                                                        id="generate-password">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="address">Address</label>
                                            <textarea name="address" class="form-control" placeholder="Enter Address" id="address"><?php echo e(old('address')); ?></textarea>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid address.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-3 d-flex">Status</label>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="customRadioInline1" name="is_verified"
                                                    class="form-check-input" value="1">
                                                <label class="form-check-label" for="customRadioInline1">Verified</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="customRadioInline2" name="is_verified"
                                                    class="form-check-input" value="0">
                                                <label class="form-check-label" for="customRadioInline2">Not
                                                    Verified</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex">

                                    <button type="button" class="btn btn-grd-danger text-light "
                                        data-bs-dismiss="modal">Close</button>


                                    <button type="submit" id="submitBtn"
                                        class="btn btn-grd-primary px-4 mx-2 text-light">Submit</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/dashboard-assets/assets/plugins/select2/js/select2-custom.js')); ?>"></script>
    <script>
        $('#email').on('keyup', function() {
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
        $('#imgInp4').on('change', function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah4').attr('src', e.target.result).css('display', 'block');
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
        document.getElementById('generate-password').addEventListener('click', function() {
            const length = 8;
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
            let password = '';

            for (let i = 0; i < length; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }

            document.getElementById('generated-password').value = password;
        });
    </script>
        <script>
        $(document).ready(function() {

            $('#companyCreateForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: '<?php echo e(route('driver.add_company')); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#submitBtn').prop('disabled', true).text('Saving...');
                    },
                    success: function(response) {
                        if (response.success) {
                            round_success_noti(response.message);
                            $('#companyCreateForm')[0].reset();
                            $('#quickCompanyAddModal').modal('hide');

                            let newCompany =
                                `<option value="${response.company.id}">${response.company.name}</option>`;
                            $('#company_id').append(newCompany);
                        } else {
                            round_error_noti('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An unexpected error occurred!';
                        if (xhr.responseJSON) {
                            if (typeof xhr.responseJSON.message === 'object') {
                                errorMessage = '';
                                $.each(xhr.responseJSON.message, function(key, value) {
                                    errorMessage += value[0] + "<br>";
                                });
                            } else if (typeof xhr.responseJSON.message === 'string') {
                                errorMessage = xhr.responseJSON.message;
                            }
                        }
                        round_error_noti(errorMessage);
                    },
                    complete: function() {
                        $('#submitBtn').prop('disabled', false).text('Submit');
                    }
                });
            });



        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/admin/branch/create.blade.php ENDPATH**/ ?>