

<?php $__env->startSection('title', 'Plan Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Plans</div>
    <div class="ps-3">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Plan Management</li>
        </ol>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row" style="height: 600px;"> <!-- Fixed card height -->
            <!-- Add Plan -->
            <div class="col-md-6 border-end overflow-auto">
                <h5>Add Plan</h5>
                <form action="<?php echo e(route('plans.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Price (₹)</label>
                            <input type="number" name="price" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Coins</label>
                            <input type="number" name="coins" class="form-control" required>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label class="form-label">Task Coin Cost</label>
                            <input type="number" name="task_coin_cost" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100">Add Plan</button>
                </form>

                <hr>
                <h6 class="mt-3">Existing Plans</h6>
                <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                    <table class="table table-bordered table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price (₹)</th>
                                <th>Coins</th>
                                <th>Task Coin Cost</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($plan->name); ?></td>
                                    <td><?php echo e($plan->price); ?></td>
                                    <td><?php echo e($plan->coins); ?></td>
                                    <td><?php echo e($plan->task_coin_cost); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary editPlanBtn" data-id="<?php echo e($plan->id); ?>">Edit</button>
                                        <form action="<?php echo e(route('plans.destroy', $plan->id)); ?>" method="POST" style="display:inline-block;">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="return confirm('Delete this plan?')" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Feature -->
            <div class="col-md-6 d-flex flex-column">
                <h5>Add Feature</h5>
                <form action="<?php echo e(route('features.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-2">
                        <label class="form-label">Feature Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" class="form-control">
                    </div>
                    <button class="btn btn-success w-100">Add Feature</button>
                </form>

                <hr>

                <h6 class="mt-3">Existing Features</h6>
                <div class="table-responsive flex-grow-1 overflow-auto">
                    <table class="table table-bordered table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($feature->name); ?></td>
                                    <td><?php echo e($feature->category); ?></td>
                                    <td><?php echo e($feature->order); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary editFeatureBtn" data-id="<?php echo e($feature->id); ?>">Edit</button>
                                        <form action="<?php echo e(route('features.destroy', $feature->id)); ?>" method="POST" style="display:inline-block;">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="return confirm('Delete this feature?')" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Mapping -->
<div class="card mt-4">
    <div class="card-body">
        <h5>Plan Feature Mapping</h5>
        <form action="<?php echo e(route('plans.updateMapping')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($plan->name); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-start"><?php echo e($feature->name); ?></td>
                                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $pivot = $plan->planFeatures->firstWhere('feature_id', $feature->id);
                                    ?>
                                    <td>
                                        <select name="mapping[<?php echo e($plan->id); ?>][<?php echo e($feature->id); ?>][availability]" class="form-select form-select-sm mb-1">
                                            <option value="no" <?php echo e($pivot?->availability == 'no' ? 'selected' : ''); ?>>No</option>
                                            <option value="partial" <?php echo e($pivot?->availability == 'partial' ? 'selected' : ''); ?>>Partial</option>
                                            <option value="yes" <?php echo e($pivot?->availability == 'yes' ? 'selected' : ''); ?>>Yes</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm"
                                               name="mapping[<?php echo e($plan->id); ?>][<?php echo e($feature->id); ?>][details]"
                                               value="<?php echo e($pivot?->details); ?>"
                                               placeholder="Details">
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-primary mt-3">Update Mapping</button>
        </form>
    </div>
</div>

<!-- Edit Plan Modal -->
<div class="modal fade" id="editPlanModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editPlanForm" method="POST">
      <?php echo csrf_field(); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Plan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Price</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Coins</label>
            <input type="number" name="coins" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Task Coin Cost</label>
            <input type="number" name="task_coin_cost" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Feature Modal -->
<div class="modal fade" id="editFeatureModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editFeatureForm" method="POST">
      <?php echo csrf_field(); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Feature</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>Category</label>
            <input type="text" name="category" class="form-control">
          </div>
          <div class="mb-2">
            <label>Order</label>
            <input type="number" name="order" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(function() {
    // Edit Plan
    $('.editPlanBtn').click(function() {
        let id = $(this).data('id');

        // Build the route URL using Blade
        let editUrl = "<?php echo e(route('plans.edit', ':id')); ?>".replace(':id', id);
        let updateUrl = "<?php echo e(route('plans.update', ':id')); ?>".replace(':id', id);

        $.get(editUrl, function(data) {
            let modal = $('#editPlanModal');
            modal.find('form').attr('action', updateUrl);
            modal.find('[name=name]').val(data.name);
            modal.find('[name=price]').val(data.price);
            modal.find('[name=coins]').val(data.coins);
            modal.find('[name=task_coin_cost]').val(data.task_coin_cost);
            modal.find('[name=description]').val(data.description);
            modal.modal('show');
        });
    });

    // Edit Feature
    $('.editFeatureBtn').click(function() {
        let id = $(this).data('id');

        let editUrl = "<?php echo e(route('features.edit', ':id')); ?>".replace(':id', id);
        let updateUrl = "<?php echo e(route('features.update', ':id')); ?>".replace(':id', id);

        $.get(editUrl, function(data) {
            let modal = $('#editFeatureModal');
            modal.find('form').attr('action', updateUrl);
            modal.find('[name=name]').val(data.name);
            modal.find('[name=category]').val(data.category);
            modal.find('[name=order]').val(data.order);
            modal.modal('show');
        });
    });
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/plan/index.blade.php ENDPATH**/ ?>