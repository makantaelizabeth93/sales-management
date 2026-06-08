<?php
// Protect page and ensure the user is logged in
require_once __DIR__ . '/includes/auth.php';
require_login();

// Load dashboard statistics from the database
$totalProducts = $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$todaySales = $pdo->prepare('SELECT COUNT(*) FROM sales WHERE DATE(sale_date) = CURDATE()');
$todaySales->execute();
$todaySalesCount = $todaySales->fetchColumn();
$todayRevenue = $pdo->prepare('SELECT IFNULL(SUM(total), 0) FROM sales WHERE DATE(sale_date) = CURDATE()');
$todayRevenue->execute();
$todayRevenueTotal = $todayRevenue->fetchColumn();
$stockRemaining = $pdo->query('SELECT IFNULL(SUM(stock), 0) FROM products')->fetchColumn();

require_once __DIR__ . '/includes/header.php';
?>
<h1 class="mb-4"><?= htmlspecialchars(t('dashboard_title')) ?></h1>
<div class="row g-4">
    <div class="col-md-3">
        <div class="card card-small shadow-sm">
            <div class="card-body">
                <h6 class="text-uppercase text-muted"><?= htmlspecialchars(t('total_products')) ?></h6>
                <h2><?= number_format($totalProducts) ?></h2>
                <p class="mb-0"><?= htmlspecialchars(t('product_overview')) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-small shadow-sm">
            <div class="card-body">
                <h6 class="text-uppercase text-muted"><?= htmlspecialchars(t('today_sales')) ?></h6>
                <h2><?= number_format($todaySalesCount) ?></h2>
                <p class="mb-0"><?= htmlspecialchars(t('today_sales')) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-small shadow-sm">
            <div class="card-body">
                <h6 class="text-uppercase text-muted"><?= htmlspecialchars(t('today_revenue')) ?></h6>
                <h2>TZS <?= number_format($todayRevenueTotal, 2) ?></h2>
                <p class="mb-0"><?= htmlspecialchars(t('today_revenue')) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-small shadow-sm">
            <div class="card-body">
                <h6 class="text-uppercase text-muted"><?= htmlspecialchars(t('stock_remaining')) ?></h6>
                <h2><?= number_format($stockRemaining) ?></h2>
                <p class="mb-0"><?= htmlspecialchars(t('stock_remaining')) ?></p>
            </div>
        </div>
    </div>
</div>



<?php require_once __DIR__ . '/includes/footer.php'; ?>