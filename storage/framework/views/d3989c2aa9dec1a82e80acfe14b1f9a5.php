

<?php $__env->startSection('content'); ?>
<div class="container px-4 py-6">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" style="font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color: var(--muted);">
            <i class="fas fa-exchange-alt me-2"></i>Transactions Management
        </h1>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="fas fa-receipt fa-2x"></i>
                    </div>
                    <h4 class="mb-1"><?php echo e($transactions->count()); ?></h4>
                    <small class="text-muted">Total Transactions</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <h4 class="mb-1">Rp <?php echo e(number_format($transactions->sum('total'), 0, ',', '.')); ?></h4>
                    <small class="text-muted">Total Revenue</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4 class="mb-1"><?php echo e($transactions->unique('customer_id')->count()); ?></h4>
                    <small class="text-muted">Unique Customers</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                    </div>
                    <h4 class="mb-1"><?php echo e($transactions->sum(fn($t) => $t->transactionDetails->sum('quantity'))); ?></h4>
                    <small class="text-muted">Items Sold</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0 text-primary">
                <i class="fas fa-list me-2"></i>All Transactions (<?php echo e($transactions->count()); ?>)
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-user me-1"></i>Customer</th>
                            <th><i class="fas fa-dollar-sign me-1"></i>Total</th>
                            <th><i class="fas fa-calendar me-1"></i>Date</th>
                            <th><i class="fas fa-info-circle me-1"></i>Status</th>
                            <th><i class="fas fa-cogs me-1"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <code class="text-primary">#<?php echo e($t->id); ?></code>
                            </td>
                            <td>
                                <div>
                                    <strong><?php echo e($t->customer?->name ?? 'N/A'); ?></strong>
                                    <?php if($t->customer?->email): ?>
                                        <br><small class="text-muted"><?php echo e($t->customer->email); ?></small>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-success">Rp <?php echo e(number_format($t->total, 0, ',', '.')); ?></span>
                            </td>
                            <td>
                                <div>
                                    <strong><?php echo e($t->transaction_date ? $t->transaction_date->format('d/m/Y') : $t->created_at->format('d/m/Y')); ?></strong>
                                    <br><small class="text-muted"><?php echo e($t->transaction_date ? $t->transaction_date->format('H:i') : $t->created_at->format('H:i')); ?></small>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-success"><?php echo e(ucfirst($t->status)); ?></span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.transactions.show', $t)); ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye me-1"></i>View Details
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                <p>No transactions found.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\thrift-shop\thrift-shop\resources\views/admin/transactions/index.blade.php ENDPATH**/ ?>