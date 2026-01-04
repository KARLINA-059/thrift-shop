

<?php $__env->startSection('content'); ?>
<div class="container px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Categories</h1>
    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary mb-4">Create Category</a>

    <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($cat->name); ?></td>
                <td><?php echo e($cat->description); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.categories.edit', $cat)); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="<?php echo e(route('admin.categories.destroy', $cat)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\thrift-shop\thrift-shop\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>