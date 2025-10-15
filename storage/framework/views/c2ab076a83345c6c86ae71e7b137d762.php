

<?php $__env->startSection('title', 'Trip Summary Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Trip Summary</div>
    <div class="ps-3">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Trip Summary Report</li>
        </ol>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Branch</th>
                        <th>Shop Name</th>
                        <th>Vehicle No</th>
                        <th>Trip Date</th>
                        <th>Total Stops</th>
                        <th>Total Deliveries</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($report->branch->name ?? 'N/A'); ?></td>
                            <td><?php echo e($report->shop_name ?? 'N/A'); ?></td>
                            <td><?php echo e($report->vehicle_no ?? 'N/A'); ?></td>
                            <td><?php echo e($report->created_at->format('d M Y')); ?></td>
                            <td><?php echo e(rand(3,8)); ?></td>
                            <td><?php echo e(rand(10,25)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($reports->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/reports/trip_summary.blade.php ENDPATH**/ ?>