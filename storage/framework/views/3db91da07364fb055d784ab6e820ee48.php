

<?php $__env->startSection('title', 'Emergency SOS Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Emergency SOS</div>
    <div class="ps-3">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">SOS Report</li>
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
                        <th>Driver Name</th>
                        <th>Contact</th>
                        <th>Message</th>
                        <th>Location</th>
                        <th>SOS Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($report->driver->name); ?></td>
                            <td><?php echo e($report->driver->phone); ?></td>
                            <td><?php echo e($report->message); ?></td>
                            <td>
                                <a href="https://www.google.com/maps?q=<?php echo e($report->latitude); ?>,<?php echo e($report->longitude); ?>" target="_blank">
                                    <?php echo e($report->latitude); ?>,<?php echo e($report->longitude); ?>

                                </a>
                            </td>
                            <td><?php echo e(format_datetime($report->created_at)); ?></td>
                            <td><span class="badge bg-danger">Emergency</span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($reports->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/reports/sos_report.blade.php ENDPATH**/ ?>