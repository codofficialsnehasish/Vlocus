<?php $__env->startSection('title'); ?>
    Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Settings</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <form action="<?php echo e(route('settings.update')); ?>" method="POST" enctype="multipart/form-data" class="needs-validation"
        novalidate>
        <?php echo csrf_field(); ?>
        <div class="row">
            <!-- General Info -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">General Information</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="site_name" class="form-label">Site Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="site_name" name="site_name"
                                value="<?php echo e(old('site_name', $setting->site_name ?? '')); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Site Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo e(old('description', $setting->description ?? '')); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branding -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Branding</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Site Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">



                            <?php if($setting && $setting->hasMedia('logo')): ?>
                                <img src="<?php echo e($setting->getFirstMediaUrl('logo')); ?>" alt="Logo" height="60"
                                    class="mt-2">
                            <?php endif; ?>



                        </div>
                        <div class="mb-3">
                            <label for="favicon" class="form-label">Favicon</label>
                            <input type="file" class="form-control" id="favicon" name="favicon">

                
                            <?php if($setting && $setting->hasMedia('favicon')): ?>
                                <img src="<?php echo e($setting->getFirstMediaUrl('favicon')); ?>" alt="Logo" height="60"
                                    class="mt-2">
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Contact Information</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Contact Email</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email"
                                value="<?php echo e(old('contact_email', $setting->contact_email ?? '')); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone"
                                value="<?php echo e(old('contact_phone', $setting->contact_phone ?? '')); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2"><?php echo e(old('address', $setting->address ?? '')); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Social Media Links</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="facebook_link" class="form-label">Facebook</label>
                            <input type="url" class="form-control" id="facebook_link" name="facebook_link"
                                value="<?php echo e(old('facebook_link', $setting->facebook_link ?? '')); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="twitter_link" class="form-label">Twitter</label>
                            <input type="url" class="form-control" id="twitter_link" name="twitter_link"
                                value="<?php echo e(old('twitter_link', $setting->twitter_link ?? '')); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="instagram_link" class="form-label">Instagram</label>
                            <input type="url" class="form-control" id="instagram_link" name="instagram_link"
                                value="<?php echo e(old('instagram_link', $setting->instagram_link ?? '')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Radius</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="cab_search_radius" class="form-label">Cab Searh Radius (K.M)</label>
                            <input type="text" class="form-control" id="cab_search_radius" name="cab_search_radius"
                                value="<?php echo e(old('cab_search_radius', $setting->cab_search_radius ?? '')); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nearby_search_radius" class="form-label">NearBy Searh Radius (K.M)</label>
                            <input type="text" class="form-control" id="nearby_search_radius"
                                name="nearby_search_radius"
                                value="<?php echo e(old('nearby_search_radius', $setting->nearby_search_radius ?? '')); ?>">
                        </div>

                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success px-5">Save Settings</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/admin/settings/settings.blade.php ENDPATH**/ ?>