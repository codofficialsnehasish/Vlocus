

<?php $__env->startSection('title', 'Route History Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Route History</div>
    <div class="ps-3">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Route History Report</li>
        </ol>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-4">
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" value="<?php echo e(request('start_date')); ?>">
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
        <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Date</th>
                        <th>Vehicle</th>
                        <th>Driver</th>
                        <th>Total Stops</th>
                        <th>Total Distance</th>
                        <th>View Route</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($schedule->delivery_date)->format('d-m-Y')); ?></td>
                            <td><?php echo e($schedule->vehicle->vehicle_number ?? 'N/A'); ?></td>
                            <td><?php echo e($schedule->driver->name ?? 'N/A'); ?></td>
                            <td><?php echo e($schedule->shops->count()); ?></td>
                            <td><?php echo e($schedule->total_distance); ?></td>
                            <td>
                                <?php if($schedule->route_polyline): ?>
                                    <a href="https://www.google.com/maps/dir/?api=1&origin=<?php echo e($schedule->deliveryScheduleShops->first()->accepted_lat); ?>,<?php echo e($schedule->deliveryScheduleShops->first()->accepted_long); ?>&destination=<?php echo e($schedule->deliveryScheduleShops->last()->deliver_lat); ?>,<?php echo e($schedule->deliveryScheduleShops->last()->deliver_long); ?>&travelmode=driving"
                                    class="btn btn-sm btn-success" target="_blank">View Map</a>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/reports/route_history.blade.php ENDPATH**/ ?>