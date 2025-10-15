<?php $__env->startSection('title', $page->meta_title ?? 'Blog'); ?>
<?php $__env->startSection('meta_description', $page->meta_description ?? ''); ?>
<?php $__env->startSection('meta_keywords', $page->meta_keywords ?? ''); ?>
<?php $__env->startSection('css'); ?>
<style>
section.top_banner.blog.pt-5.pb-0.bg-light{
text-align: center;
}
</style>


    <?php $__env->stopSection(); ?>    

<?php $__env->startSection('content'); ?>

<section class="top_banner blog pt-5 pb-0">
    <div class="container">
        <h1 class="mb-3 text-center">Welcome to Our Blog</h1>
        <p class="lead text-center">Stay updated with the latest insights, news, and expert opinions.</p>
    </div>
</section>

<section class="blog-posts pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="blog_img_size">
                    <img src="<?php echo e(asset('assets/frontend_assets/img/home/blog5.jpg')); ?>" class="card-img-top" alt="Post 1">
                </div>
                    <div class="card-body">
                        <h5 class="card-title">Post Title 1</h5>
                        <p class="card-text">A brief description of the blog post.</p>
                        <a href="#" class="btn btn_style">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="blog_img_size">
                    <img src="<?php echo e(asset('assets/frontend_assets/img/home/blog1.png')); ?>" class="card-img-top" alt="Post 2">
                </div>
                    <div class="card-body">
                        <h5 class="card-title">Post Title 2</h5>
                        <p class="card-text">A brief description of the blog post.</p>
                        <a href="#" class="btn btn_style">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="blog_img_size">
                    <img src="<?php echo e(asset('assets/frontend_assets/img/home/blog2.png')); ?>" class="card-img-top" alt="Post 3">
                </div>
                    <div class="card-body">
                        <h5 class="card-title">Post Title 3</h5>
                        <p class="card-text">A brief description of the blog post.</p>
                        <a href="#" class="btn btn_style">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn_style">View More Posts</a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/frontend/blog.blade.php ENDPATH**/ ?>