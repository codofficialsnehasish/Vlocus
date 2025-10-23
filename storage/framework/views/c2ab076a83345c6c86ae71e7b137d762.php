

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

<?php echo e($reports); ?>

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Date</th>
                        <th>Vehicle</th>
                        <th>Driver</th>
                        <th>Start Location</th>
                        <th>End Location</th>
                        <th>Distance (km)</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration</th>
                        <th>Stops</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                            <td><?php echo e($key + 1); ?></td>

                            
                            <td><?php echo e(optional($report->deliverySchedule)->delivery_date ?? '-'); ?></td>

                            
                            <td><?php echo e(optional($report->deliverySchedule->vehicle)->vehicle_number ?? 'N/A'); ?></td>

                            
                            <td><?php echo e(optional($report->deliverySchedule->driver)->name ?? 'N/A'); ?></td>

                            
                            <td><?php echo e($report->accepted_lat); ?>,<?php echo e($report->accepted_long); ?></td>

                            
                            <td><?php echo e($report->deliverd_lat); ?>,<?php echo e($report->deliverd_long); ?></td>

                            
                            <td><?php echo e($report->distance ?? 'N/A'); ?></td>

                            
                            <td><?php echo e($report->accepted_at ? \Carbon\Carbon::parse($report->accepted_at)->format('H:i:s') : '-'); ?></td>

                            
                            <td><?php echo e($report->delivered_at ? \Carbon\Carbon::parse($report->delivered_at)->format('H:i:s') : '-'); ?></td>

                            
                            <td>
                                <?php if($report->accepted_at && $report->delivered_at): ?>
                                    <?php
                                        $start = \Carbon\Carbon::parse($report->accepted_at);
                                        $end = \Carbon\Carbon::parse($report->delivered_at);
                                        $duration = $end->diff($start);
                                    ?>
                                    <?php echo e($duration->format('%d days %H:%I:%S')); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            
                            <td><?php echo e($reports->where('delivery_schedule_id', $report->delivery_schedule_id)->count()); ?></td>

                            
                            <td><?php echo e(optional($report->deliverySchedule)->status ?? '-'); ?></td>

                            
                            <td><?php echo e($report->remarks ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/reports/trip_summary.blade.php ENDPATH**/ ?>