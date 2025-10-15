    <?php $__env->startSection('title'); ?> Dashboard <?php $__env->stopSection(); ?>
    
    <?php $__env->startSection('content'); ?>


    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Role Permission</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('dashboard')); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Permission Create')): ?>
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-plus-lg me-2"></i>Add New Permission</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <!--end breadcrumb-->

    <div class="card mt-4">
        <div class="card-body">
            <div class="product-table">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Permission Name</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Permission Edit','Permission Delete'])): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($permission->name); ?></td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Permission Edit','Permission Delete'])): ?>
                                <td class="d-flex">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Permission Edit')): ?>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdropedit<?php echo e($permission->id); ?>" style="margin-right: 10px;"> 
                                        <i class="text-primary" data-feather="edit"></i>
                                    </button>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Permission Delete')): ?>
                                    <a class="btn" href="javascript:void(0);" onclick="deleteItem(this)"
                                                    data-url="<?php echo e(route('permission.destroy', ['permissionId' => $permission->id])); ?>" data-item="Route"
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


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('permission.create')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="position-relative">
                        <label for="permission-name" class="form-label">Permission Name</label>
                        <input type="text" name="name" class="form-control" id="permission-name" placeholder="Write permission name here..." required="">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    
    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="staticBackdropedit<?php echo e($permission->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('permission.update', ['permissionId' => $permission->id])); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="position-relative">
                        <label for="role-name" class="form-label">Permission Name</label>
                        <input type="text" name="name" class="form-control" id="role-name" placeholder="Write Permission name here..." value="<?php echo e($permission->name); ?>" required="">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/admin/roles_permission/permission.blade.php ENDPATH**/ ?>