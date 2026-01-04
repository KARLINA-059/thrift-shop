

<?php $__env->startSection('content'); ?>
<div class="container px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary mb-4">Create Product</a>

    <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td>
                    <?php if($p->image): ?>
                        <img src="<?php echo e(asset('storage/' . $p->image)); ?>" alt="<?php echo e($p->name); ?>" style="width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd;">
                    <?php else: ?>
                        <div style="width: 60px; height: 60px; background: #f8f9fa; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    <?php endif; ?>
                </td>
                <td><?php echo e($p->name); ?></td>
                <td><?php echo e($p->category?->name); ?></td>
                <td><?php echo e(number_format($p->price,2)); ?></td>
                <td><?php echo e($p->stock); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.products.edit', $p)); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="<?php echo e(route('admin.products.destroy', $p)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete?');">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\thrift-shop\thrift-shop\resources\views/admin/products/index.blade.php ENDPATH**/ ?>