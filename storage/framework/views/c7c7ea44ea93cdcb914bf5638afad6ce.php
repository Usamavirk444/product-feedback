<?php if(session('errors')): ?>
<div class="alert alert-danger">
    <?php echo e(session('errors')); ?>

</div>
<?php endif; ?>
<?php if(session('success')): ?>
<div class="alert alert-success">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\product-feedback\resources\views/alerts.blade.php ENDPATH**/ ?>