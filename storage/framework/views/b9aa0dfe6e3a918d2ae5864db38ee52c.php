<?php $__env->startSection('title'); ?> Delivery Schedule <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Delivery Schedule</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Delivery Schedule</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delivery Schedule Create')): ?>
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a class="btn btn-primary px-4" href="<?php echo e(route('delivery-schedule.create')); ?>"><i class="bi bi-plus-lg me-2"></i>Add New</a>
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
                                <th>Delevery Date</th>
                                <th>Driver</th>
                                <th>Vehicle</th>
                                <th>Total Shop</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Delivery Schedule Edit', 'Delivery Schedule Delete'])): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($delivery_schedules->isNotEmpty()): ?>
                                <?php $__currentLoopData = $delivery_schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->delivery_date); ?></td>
                                    <td><?php echo e($item->driver?->name); ?></td>
                                    <td><?php echo e($item->vehicle?->name); ?></td>
                                    <td><?php echo e($item->deliveryScheduleShops?->count()); ?></td>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Delivery Schedule Edit', 'Delivery Schedule Delete'])): ?>
                                        <td class="d-flex">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delivery Schedule Edit')): ?>
                                                <a class="btn" href="<?php echo e(route('delivery-schedule.edit', $item->id)); ?>" alt="edit"><i
                                                        class="text-primary" data-feather="edit"></i></a>
                                            <?php endif; ?>
                                            <a class="btn" href="<?php echo e(route('delivery-schedule.show', $item->id)); ?>" alt="edit"><i class="text-primary" data-feather="eye"></i></a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delivery Schedule Delete')): ?>
                                                <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                    data-url="<?php echo e(route('delivery-schedule.destroy',$item->id)); ?>" data-item="Delivery Schedule"
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/admin/delivery_schedules/index.blade.php ENDPATH**/ ?>