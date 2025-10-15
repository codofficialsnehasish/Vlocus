    <?php $__env->startSection('title'); ?> Users <?php $__env->stopSection(); ?>
    
    <?php $__env->startSection('content'); ?>

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('dashboard')); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Users Create')): ?>
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a class="btn btn-primary px-4" href="<?php echo e(route('user.create')); ?>"><i class="bi bi-plus-lg me-2"></i>Add New Users</a>
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
                                
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Registred Date</th>
                                <th>Status</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Users Edit','Users Delete'])): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                
                                <td><span class="font-16"><?php echo e($user->name); ?></span></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->phone); ?></td>
                                <td><?php echo e($user->getRoleNames()->first()); ?></td>
                                <td><?php echo e(format_datetime($user->created_at)); ?></td>
                                <td><?php echo check_status($user->status); ?></td>
                                <td>
                                    <a href="<?php echo e(route('user.show',$user->id)); ?>" class="btn btn-icon btn-sm" title="View"><i class="text-info" data-feather="eye"></i></a>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Users Delete')): ?>
                                    <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                    data-url="<?php echo e(route('user.destroy',$user->id)); ?>" data-item="Users"
                                                    alt="delete"><i
                                                    class="text-danger" data-feather="trash-2"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/users/index.blade.php ENDPATH**/ ?>