<?php $__env->startSection('title'); ?>
Branchs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Branchs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Branch's</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Branch Create')): ?>
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a class="btn btn-primary px-4" href="<?php echo e(route('branch.create')); ?>"><i
                            class="bi bi-plus-lg me-2"></i>Add New Branch</a>
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
                                <th>Sl No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Registred Date</th>
                                <th>Status</th>
                                <?php if (! (auth()->user()->hasRole('Company'))): ?>
                                <th>Company Name</th>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Branch Edit', 'Branch Delete'])): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td class="w60">
                                        <img class="avatar" width="50"
                                            src="<?php echo e($user->getFirstMediaUrl('system-user-image')); ?>" alt="">
                                    </td>
                                    <td><span class="font-16"><?php echo e($user->name); ?></span></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->phone); ?></td>
                                    <td><?php echo e($user->getRoleNames()->first()); ?></td>
                                    <td><?php echo e(format_datetime($user->created_at)); ?></td>
                                    <td><?php echo check_status($user->status); ?></td>
                                    <?php if (! (auth()->user()->hasRole('Company'))): ?>
                                    <td><?php echo e($user->branch?->company?->name ?? 'N/A'); ?></td>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Branch Edit', 'Branch Delete'])): ?>
                                    <td>
                                        
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Branch Edit')): ?>
                                            <a href="<?php echo e(route('branch.edit', $user->id)); ?>" class="btn btn-icon btn-sm"
                                                title="Edit"><i class="text-primary" data-feather="edit"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Branch Delete')): ?>
                                            <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                    data-url="<?php echo e(route('branch.delete', $user->id)); ?>" data-item="Driver"
                                                    alt="delete"><i
                                                    class="text-danger" data-feather="trash-2"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/branch/index.blade.php ENDPATH**/ ?>