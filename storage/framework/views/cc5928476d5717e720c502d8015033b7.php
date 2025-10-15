<?php $__env->startSection('title'); ?>
    Vehicle
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vehicle</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Vehicle</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <a class="btn btn-primary px-4" href="<?php echo e(route('vehicle.index')); ?>"><i
                        class="fadeIn animated bx bx-arrow-back"></i>Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <form method="POST" action="<?php echo e(route('vehicle.store')); ?>" enctype="multipart/form-data" class="needs-validation"
        novalidate>
        <?php echo csrf_field(); ?>
        <div class="row">
            <!-- Left Column: Vehicle Details -->
            <div class="col-md-9">
                <div class="card mt-4">
                    <div class="card-header text-center">Add Vehicle Details</div>
                    <div class="card-body">
                        <div class="row">
                            
                                <div class="row">
                                    <!-- Vehicle Name -->
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Vehicle Name" value="<?php echo e(old('name')); ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter the vehicle name.</div>
                                    </div>

                             

                                    <!-- Vehicle Number -->
                                    <div class="mb-3 col-md-6">
                                        <label for="vehicle_number" class="form-label">Vehicle Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="vehicle_number" id="vehicle_number"
                                            placeholder="Enter Vehicle Number" value="<?php echo e(old('vehicle_number')); ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter the vehicle number.</div>
                                    </div>

                                    <!-- RWC Number -->
                                    <div class="mb-3 col-md-6">
                                        <label for="rwc_number" class="form-label">RWC Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="rwc_number" id="rwc_number"
                                            placeholder="Enter RWC Number" value="<?php echo e(old('rwc_number')); ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter the RWC number.</div>
                                    </div>

                                    <!-- RWC Number -->
                                    <div class="mb-3 col-md-6">
                                        <label for="rwc_number" class="form-label">Engine Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="engine_number" id="engine_number"
                                            placeholder="Enter RWC Number" value="<?php echo e(old('engine_number')); ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter the Engine number.</div>
                                    </div>

                                    <!-- Brand -->
                                    <div class="mb-3 col-md-6">
                                        <label for="brand_id" class="form-label">Brand <span
                                                class="text-danger">*</span></label>

                                        <select class="form-select" name="brand_id" id="brand_id" required>
                                            <option value="" selected>Select Brand</option>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($brand->id); ?>"
                                                    <?php echo e(old('brand_id') == $brand->id ? 'selected' : ''); ?>>
                                                    <?php echo e($brand->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="invalid-feedback">Please select a brand.</div>
                                    </div>

                                    <!-- Model -->
                                    <div class="mb-3 col-md-6">
                                        <label for="model_id" class="form-label">Model <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="model_id" id="model_id" required>
                                            <option value="" selected>Select Model</option>

                                        </select>
                                        <div class="invalid-feedback">Please select a model.</div>
                                    </div>

                                    <!-- Color -->
                                    <div class="mb-3 col-md-6">
                                        <label for="color_id" class="form-label">Color <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="color_id" id="color_id" required>
                                            <option value="" selected>Select Color</option>
                                            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($color->id); ?>"
                                                    <?php echo e(old('color_id') == $color->id ? 'selected' : ''); ?>>
                                                    <?php echo e($color->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                        <div class="invalid-feedback">Please select a color.</div>
                                    </div>


                                    <!-- Body Type -->
                                    <div class="mb-3 col-md-6">
                                        <label for="body_type" class="form-label">Body Type</label>
                                        <input type="text" class="form-control" name="body_type" id="body_type"
                                            placeholder="Enter Body Type" value="<?php echo e(old('body_type')); ?>">
                                        <div class="invalid-feedback">Please enter a valid body type.</div>
                                    </div>

                                    <!-- Vehicle Condition -->
                                    <div class="mb-3 col-md-6">
                                        <label for="vehicle_condition" class="form-label">Vehicle Condition</label>

                                        <select class="form-select" name="vehicle_condition" id="vehicle_condition"
                                            required>
                                            <option value="0"
                                                <?php echo e(old('vehicle_condition') == '0' ? 'selected' : ''); ?>>New</option>
                                            <option value="1"
                                                <?php echo e(old('vehicle_condition') == '1' ? 'selected' : ''); ?>>Second Hand
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Please enter a valid vehicle condition.</div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="vehicle_condition" class="form-label">Engine Type</label>

                                        <select class="form-select" name="engine_type" id="engine_type" required>
                                            <option value="0" <?php echo e(old('engine_type') == '0' ? 'selected' : ''); ?>>
                                                Pyston</option>
                                            <option value="1" <?php echo e(old('engine_type') == '1' ? 'selected' : ''); ?>>
                                                Electric
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Please enter a valid Engine type.</div>
                                    </div>
                                    <!-- Transmission -->
                                    <div class="mb-3 col-md-6">
                                        <label for="transmisssion" class="form-label">Transmission</label>

                                        <select class="form-select" name="transmisssion" id="transmisssion" required>
                                            <option value="0" <?php echo e(old('transmisssion') == '0' ? 'selected' : ''); ?>>
                                                Automactic
                                            </option>
                                            <option value="1" <?php echo e(old('transmisssion') == '1' ? 'selected' : ''); ?>>
                                                Manul</option>
                                        </select>
                                        <div class="invalid-feedback">Please enter the transmission type.</div>
                                    </div>

                                    <!-- Fuel Type -->
                                    <div class="mb-3 col-md-6">
                                        <label for="fuel_type" class="form-label">Fuel Type</label>

                                        <select class="form-select" name="fuel_type" id="fuel_type" required>
                                            <option value="0" <?php echo e(old('fuel_type') == '0' ? 'selected' : ''); ?>>Petrol
                                            </option>
                                            <option value="1" <?php echo e(old('fuel_type') == '1' ? 'selected' : ''); ?>>Disel
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Please enter a valid fuel type.</div>
                                    </div>

                                    <!-- Left Hand Drive -->
                                    <div class="mb-3 col-md-6">
                                        <label for="left_hand_drive" class="form-label">Left Hand Drive <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="left_hand_drive" id="left_hand_drive" required>
                                            <option value="0" <?php echo e(old('left_hand_drive') == '0' ? 'selected' : ''); ?>>
                                                No</option>
                                            <option value="1" <?php echo e(old('left_hand_drive') == '1' ? 'selected' : ''); ?>>
                                                Yes</option>
                                        </select>
                                        <div class="invalid-feedback">Please select an option.</div>
                                    </div>

                                    <!-- Hybrid -->
                                    <div class="mb-3 col-md-6">
                                        <label for="hybird" class="form-label">Hybrid <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="hybird" id="hybird" required>
                                            <option value="0" <?php echo e(old('hybird') == '0' ? 'selected' : ''); ?>>No
                                            </option>
                                            <option value="1" <?php echo e(old('hybird') == '1' ? 'selected' : ''); ?>>Yes
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Please select an option.</div>
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="brand_id" class="form-label">Vehicle Type <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="vehicle_type" id="vehicle_type" required>
                                            <option value="" selected>Select Vehicle Type</option>
                                            <?php $__currentLoopData = $vehicle_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($vehicle_type->id); ?>"
                                                    <?php echo e(old('vehicle_type') == $vehicle_type->id ? 'selected' : ''); ?>>
                                                    <?php echo e($vehicle_type->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="invalid-feedback">Please select a vehicle type.</div>
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="ac_status" class="form-label">AC status <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="ac_status" id="ac_status" required>
                                            <option value="" selected disabled>Select AC Status</option>
                                            <option value="AC" <?php echo e(old('ac_status') == 'AC' ? 'selected' : ''); ?>>AC
                                            </option>
                                            <option value="Non AC" <?php echo e(old('ac_status') == 'Non AC' ? 'selected' : ''); ?>>
                                                Non AC</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a ac status.</div>
                                    </div>





                                    <!-- Description -->
                                    <div class="mb-3 col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter Description"><?php echo e(old('description')); ?></textarea>
                                        <div class="invalid-feedback">Please enter a valid description.</div>
                                    </div>

                                </div>
                        
                            <div class="col-md-6">
                                <div id="seatLegend" class="mb-3" style="display: none;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="legend-item d-flex align-items-center">
                                            <div class="legend-color ladies-seat"></div>
                                            <span>Ladies Seat</span>
                                        </div>
                                        <div class="legend-item d-flex align-items-center">
                                            <div class="legend-color senior-seat"></div>
                                            <span>Senior Citizen Seat</span>
                                        </div>
                                        <div class="legend-item d-flex align-items-center">
                                            <div class="legend-color handicapped-seat"></div>
                                            <span>Handicapped Seat</span>
                                        </div>
                                        <div class="legend-item d-flex align-items-center">
                                            <div class="legend-color regular-seat"></div>
                                            <span>Regular Seat</span>
                                        </div>
                                    </div>
                                </div>

                                <div id="seatLayoutContainer" class="d-flex flex-wrap justify-content-center gap-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Vehicle Image and Publish Options -->
            <div class="col-md-3">
                <div class="row">
                    <div class="card mt-4">
                        <div class="card-header text-center">Add Vehicle Image</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <img class="img-thumbnail rounded me-2" id="blah" alt="" width="200"
                                    src="" data-holder-rendered="true" style="display: none;">

                            </div>
                            <div class="mb-3">
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
                                    <input type="radio" id="active" name="is_visible" class="form-check-input"
                                        value="1" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="inactive" name="is_visible" class="form-check-input"
                                        value="0">
                                    <label class="form-check-label" for="inactive">Inactive</label>
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
    

  
        $(document).ready(function() {
            $('#brand_id').on('change', function() {
                var brandId = $(this).val();
                var $modelSelect = $('#model_id');

                if (brandId) {
                    $.ajax({
                        url: "<?php echo e(route('vehicle.get-models', ['brandId' => ':brandId'])); ?>"
                            .replace(':brandId', brandId),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var options = '<option value="">Select Model</option>';
                            $.each(data.models, function(index, model) {
                                options += '<option value="' + model.id + '">' + model
                                    .name + '</option>';
                            });
                            $modelSelect.html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching models:', error);
                        }
                    });
                } else {
                    $modelSelect.html('<option value="">Select Model</option>');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/admin/vehicle/create.blade.php ENDPATH**/ ?>