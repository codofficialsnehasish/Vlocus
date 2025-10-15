<?php $__env->startSection('title'); ?>
Vehicle Types
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vehicle Types</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vehicle Type</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vehicle Type Create')): ?>
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a class="btn btn-primary px-4" href="<?php echo e(route('vehicle-type.create')); ?>"><i class="bi bi-plus-lg me-2"></i>Add
                        New</a>
                </div>
            <?php endif; ?>
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
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Vehicle Type Edit', 'Vehicle Type Delete'])): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($vehicle_types->isNotEmpty()): ?>
                            <?php
                                $i = 1;
                            ?>
                                
                                <?php $__currentLoopData = $vehicle_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><img src="<?php echo e($item->getFirstMediaUrl('vehicle-type-icon')); ?>" alt="" width="50"></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->description); ?></td>

                                    <td><?php echo check_status($item->is_visible); ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Vehicle Type Edit', 'Vehicle Type Delete'])): ?>
                                        <td class="d-flex">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vehicle Type Edit')): ?>
                                                <a class="btn" href="<?php echo e(route('vehicle-type.edit', $item->id)); ?>" alt="edit"><i
                                                        class="text-primary" data-feather="edit"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vehicle Type Delete')): ?>
                                                <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                    data-url="<?php echo e(route('vehicle-type.delete', $item->id)); ?>" data-item="Route"
                                                    alt="delete"><i
                                                    class="text-danger" data-feather="trash-2"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/admin/vehicle_type/index.blade.php ENDPATH**/ ?>