<?php $__env->startSection('title'); ?>
    SOS Alrets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">SOS Alrets</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">
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
              
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Brand Edit', 'Brand Delete'])): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($sos_alerts->isNotEmpty()): ?>
                                <?php
                                    $i = 1;
                                ?>

                                <?php $__currentLoopData = $sos_alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($item->driver->name); ?></td>
                                        <td><?php echo e($item->driver->phone); ?></td>
                                        <td><?php echo e($item->message); ?></td>
                                        <td><?php echo e($item->latitude); ?></td>
                                        <td><?php echo e($item->longitude); ?></td>


                            
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Brand Edit', 'Brand Delete'])): ?>
                                            <td class="d-flex">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Brand Edit')): ?>
                                                    <a class="btn" href="<?php echo e(route('brand.edit', $item->id)); ?>" alt="edit"><i
                                                            class="text-primary" data-feather="edit"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Brand Delete')): ?>
                                                    <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                        data-url="<?php echo e(route('sos_alert.delete', $item->id)); ?>" data-item="SOS Alert"
                                                        alt="delete"><i class="text-danger" data-feather="trash-2"></i></a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/sos_alert/index.blade.php ENDPATH**/ ?>