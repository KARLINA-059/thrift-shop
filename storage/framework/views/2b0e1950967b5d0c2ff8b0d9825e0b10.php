

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="mb-0" style="font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; font-size:28px; color:var(--muted);">Admin Dashboard</h1>
            <p class="text-muted small mb-0">Ringkasan operasional — Thrift Shop</p>
        </div>
        <div>
            <a href="<?php echo e(route('admin.customers.index')); ?>" class="btn btn-outline-primary me-2">Customers</a>
            <a href="<?php echo e(route('admin.transactions.index')); ?>" class="btn btn-outline-primary">Transactions</a>
        </div>
    </div>

    <style>
        .admin-stats{ display:flex; gap:18px; flex-wrap:wrap; margin-bottom:22px; }
        .stat-card{ flex:1 1 280px; background: var(--card); border-radius:12px; padding:18px; border:1px solid rgba(59,58,54,0.04); box-shadow:0 8px 20px rgba(59,58,54,0.03); }
        .stat-label{ font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color:var(--muted); font-size:14px; margin-bottom:6px; }
        .stat-value{ font-size:28px; font-weight:700; color:var(--text); }
        .stat-sub{ color:rgba(59,58,54,0.6); font-size:13px; }

        .chart-card{ background: var(--card); border-radius:12px; padding:18px; border:1px solid rgba(59,58,54,0.04); box-shadow:0 8px 20px rgba(59,58,54,0.03); }
        .chart-title{ font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color:var(--muted); margin-bottom:10px; }

        /* make canvas responsive */
        .chart-container{ width:100%; height:320px; }

        @media(max-width:767px){ .chart-container{ height:260px; } .stat-value{ font-size:22px; } }
    </style>

    <!-- Metrics -->
    <div class="admin-stats">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Total Customers</div>
                    <div class="stat-value"><?php echo e($totalCustomers); ?></div>
                    <div class="stat-sub">Jumlah pelanggan terdaftar</div>
                </div>
                <div class="text-end">
                    <i class="fas fa-users fa-2x" style="color:var(--soft); opacity:0.9;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Total Transactions</div>
                    <div class="stat-value"><?php echo e($totalTransactions); ?></div>
                    <div class="stat-sub">Transaksi tercatat (rekap admin)</div>
                </div>
                <div class="text-end">
                    <i class="fas fa-receipt fa-2x" style="color:var(--soft); opacity:0.9;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Total Sales</div>
                    <div class="stat-value">Rp <?php echo e(number_format($totalSales, 0, ',', '.')); ?></div>
                    <div class="stat-sub">Akumulasi penjualan</div>
                </div>
                <div class="text-end">
                    <i class="fas fa-coins fa-2x" style="color:var(--soft); opacity:0.9;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="chart-card">
                <h2 class="chart-title">Transactions per Month</h2>
                <div class="chart-container">
                    <canvas id="transactionsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="chart-card">
                <h2 class="chart-title">Products per Category</h2>
                <div class="chart-container">
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reports Section -->
<div class="mt-5">
    <h3 class="mb-3" style="font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color:var(--muted); margin-left: 15px;">Laporan Penjualan</h3>

    <div class="row g-4">
        <!-- Total Penjualan per Bulan -->
        <div class="col-lg-4">
            <div class="chart-card">
                <h4 class="chart-title">Total Penjualan per Bulan</h4>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $monthlySales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($sale->month); ?>/<?php echo e($sale->year); ?></td>
                                <td>Rp <?php echo e(number_format($sale->total_sales, 0, ',', '.')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="2" class="text-muted text-center">Belum ada data penjualan</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Produk Terlaris -->
        <div class="col-lg-4">
            <div class="chart-card">
                <h4 class="chart-title">Produk Terlaris (Top 5)</h4>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($product->name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($product->brand); ?></small>
                                </td>
                                <td><span class="badge bg-success"><?php echo e($product->total_sold); ?> pcs</span></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="2" class="text-muted text-center">Belum ada data penjualan</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Transaksi per Kategori -->
        <div class="col-lg-4">
            <div class="chart-card">
                <h4 class="chart-title">Transaksi per Kategori</h4>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Jumlah Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $transactionsPerCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($category->category); ?></td>
                                <td><span class="badge bg-primary"><?php echo e($category->transaction_count); ?></span></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="2" class="text-muted text-center">Belum ada data transaksi</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart: Transactions per Month
    const transactionsCtx = document.getElementById('transactionsChart').getContext('2d');
    const transactionsData = <?php echo json_encode($transactionsPerMonth, 15, 512) ?>;
    const labels = transactionsData.map(item => `${item.month}/${item.year}`);
    const counts = transactionsData.map(item => item.count);

    new Chart(transactionsCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Transactions',
                data: counts,
                backgroundColor: 'rgba(79, 163, 209, 0.7)', // Biru primary
                borderColor: '#4FA3D1',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Pie Chart: Products per Category
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    const productsData = <?php echo json_encode($productsPerCategory, 15, 512) ?>;
    const categoryLabels = productsData.map(item => item.category);
    const quantities = productsData.map(item => item.total_quantity);

    new Chart(productsCtx, {
        type: 'pie',
        data: {
            labels: categoryLabels,
            datasets: [{
                data: quantities,
                backgroundColor: [
                    'rgba(79, 163, 209, 0.8)', // Primary biru
                    'rgba(47, 109, 161, 0.8)', // Secondary biru
                    'rgba(78, 147, 185, 0.8)', // Light biru
                    'rgba(109, 185, 209, 0.8)', // Very light biru
                    'rgba(15, 42, 68, 0.8)'      // Dark biru
                ],
                borderColor: [
                    '#4FA3D1',
                    '#2F6DA1',
                    '#4E93B9',
                    '#6DB9D1',
                    '#0F2A44'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>

<!-- Recent Orders -->
<div class="mt-5">
    <h3 class="mb-3" style="font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color:var(--muted); margin-left: 15px;">Recent Orders</h3>
    <div class="chart-card">
        <?php if(isset($recentOrders) && $recentOrders->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><code><?php echo e($order->order_code); ?></code></td>
                            <td><?php echo e($order->user->name); ?></td>
                            <td>Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></td>
                            <td>
                                <?php if($order->status == 'pending'): ?>
                                    <span class="order-status status-pending">Pending</span>
                                <?php elseif($order->status == 'processing'): ?>
                                    <span class="order-status status-processing">Processing</span>
                                <?php elseif($order->status == 'shipped'): ?>
                                    <span class="order-status status-shipped">Shipped</span>
                                <?php elseif($order->status == 'completed'): ?>
                                    <span class="order-status status-completed">Completed</span>
                                <?php else: ?>
                                    <span class="order-status status-cancelled">Cancelled</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($order->created_at->format('d/m/Y')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">No recent orders.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Recent Payments -->
<div class="mt-5">
    <h3 class="mb-3" style="font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color:var(--muted); margin-left: 15px;">Recent Payments</h3>
    <div class="chart-card">
        <?php if($recentPayments->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>#<?php echo e($payment->order->id); ?></td>
                            <td><?php echo e($payment->order->user->name); ?></td>
                            <td>Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></td>
                            <td>
                                <?php if($payment->status == 'pending'): ?>
                                    <span class="payment-status payment-pending">Pending</span>
                                <?php elseif($payment->status == 'verified'): ?>
                                    <span class="payment-status payment-verified">Paid</span>
                                <?php else: ?>
                                    <span class="payment-status payment-rejected">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="<?php echo e(route('admin.payments.update-status', $payment)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <select name="status" class="form-select form-select-sm d-inline w-auto">
                                        <option value="pending" <?php echo e($payment->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="verified" <?php echo e($payment->status == 'verified' ? 'selected' : ''); ?>>Verified</option>
                                        <option value="rejected" <?php echo e($payment->status == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary ms-1">Update</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">No recent payments.</p>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\thrift-shop\thrift-shop\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>