<?php $__env->startSection('body'); ?>
    <section style="background-color: #eee;">
        <?php echo $__env->make('alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-start align-items-center">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar"
                                    width="60" height="60" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1"><?php echo e($feedback->user->name); ?></h6>
                                    <p class="text-muted small mb-0">
                                        Shared publicly - <?php echo e($feedback->created_at->format('d-m-Y')); ?>

                                    </p>
                                </div>
                            </div>
                                <?php $__empty_1 = true; $__currentLoopData = $feedback->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="gallery mt-5">
                                        <a target="_blank" href="img_5terre.jpg">
                                        <img src="<?php echo e(asset('storage/'. $image->filename)); ?>" alt="" width="600" height="400">
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <?php endif; ?>
                            <h1 class="mt-3"> <strong>TITLE: </strong> <?php echo e($feedback->title); ?></h1>
                            <p class="mt-3 mb-4 pb-2">
                                <Strong> DESCRIPITION: </Strong>
                                <?php echo e($feedback->description); ?>

                            </p>

                            <div class="small d-flex justify-content-start">

                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-comment-dots me-2"></i>
                                    <p class="mb-0">Comment</p>
                                </a>
                            </div>
                        </div>
                        <?php $__currentLoopData = $feedback->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="comment p-2 m-3" style="border: 1px solid #ccc; border-radius: 5px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?php echo e($comment->user->name); ?></strong> -
                                    <?php echo e($comment->created_at->diffForHumans()); ?>

                                </div>
                                <!-- You can add a delete button here if needed -->
                            </div>
                            <p class="mt-2" style="white-space: pre-line;"><?php echo $comment->content; ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <form method="POST" action="<?php echo e(route('comments.store',$id)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <div class="d-flex flex-start w-100">
                                    <div class="form-outline w-100">
                                        <textarea class="form-control" name="content" id="comment-content" rows="4" style="background: #fff;"></textarea>
                                        <label class="form-label" for="textAreaExample">Message</label>
                                    </div>
                                </div>
                                <div class="float-end mt-2 pt-1">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Post comment</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.tiny.cloud/1/api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#comment-content',
            plugins: 'link lists',
            toolbar: 'bold italic underline strikethrough | bullist numlist | link',
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\product-feedback\resources\views/feedback/show.blade.php ENDPATH**/ ?>