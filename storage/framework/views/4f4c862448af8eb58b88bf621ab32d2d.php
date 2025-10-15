
<script src="<?php echo e(asset('assets/dashboard-assets/assets/plugins/notifications/js/lobibox.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/dashboard-assets/assets/plugins/notifications/js/notifications.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/dashboard-assets/assets/plugins/notifications/js/notification-custom-script.js')); ?>">
</script>

<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <script>
        $(document).ready(function(){
            round_warning_noti('<?php echo e($error); ?>');
        });
    </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if(Session::has("error")): ?>
    <script>
        $(document).ready(function(){
            round_error_noti('<?php echo e(Session::get("error")); ?>');
        });
    </script>
<?php endif; ?>

<?php if(Session::has("success")): ?>
    <script>
        $(document).ready(function(){
            round_success_noti('<?php echo e(Session::get("success")); ?>');
        });
    </script>
<?php endif; ?>
<?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/frontend/layouts/includes/_notification.blade.php ENDPATH**/ ?>