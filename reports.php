<?php
// Protect page and ensure the user is logged in
require_once __DIR__ . '/includes/auth.php';
require_login();

// Load summary metrics and current month sales records
$todaySales = $pdo->prepare('SELECT COUNT(*) FROM sales WHERE DATE(sale_date) = CURDATE()');
$todaySales->execute();
$todaySalesCount = $todaySales->fetchColumn();
$todayRevenue = $pdo->prepare('SELECT IFNULL(SUM(total), 0) FROM sales WHERE DATE(sale_date) = CURDATE()');
$todayRevenue->execute();
$todayRevenueTotal = $todayRevenue->fetchColumn();

$monthSales = $pdo->prepare('SELECT COUNT(*) FROM sales WHERE MONTH(sale_date) = MONTH(CURDATE()) AND YEAR(sale_date) = YEAR(CURDATE())');
$monthSales->execute();
$monthSalesCount = $monthSales->fetchColumn();
$monthRevenue = $pdo->prepare('SELECT IFNULL(SUM(total), 0) FROM sales WHERE MONTH(sale_date) = MONTH(CURDATE()) AND YEAR(sale_date) = YEAR(CURDATE())');
$monthRevenue->execute();
$monthRevenueTotal = $monthRevenue->fetchColumn();

$monthRecords = $pdo->query('SELECT s.id, p.name AS product_name, s.quantity, s.total, s.profit, s.sale_date FROM sales s JOIN products p ON s.product_id = p.id WHERE MONTH(s.sale_date) = MONTH(CURDATE()) AND YEAR(s.sale_date) = YEAR(CURDATE()) ORDER BY s.sale_date DESC')->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <div>
        <h1 class="mb-2"><?= htmlspecialchars(t('report_title')) ?></h1>
        <p class="text-muted mb-0"><?= htmlspecialchars(t('business_summary')) ?></p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <div class="badge bg-secondary text-white py-2 px-3">
            <?= htmlspecialchars(t('today_sales')) ?>: <strong><?= number_format($todaySalesCount) ?></strong>
        </div>
        <div class="badge bg-secondary text-white py-2 px-3">
            <?= htmlspecialchars(t('month_sales')) ?>: <strong><?= number_format($monthSalesCount) ?></strong>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-uppercase text-muted mb-3"><?= htmlspecialchars(t('today_revenue')) ?></h6>
                <p class="display-6 mb-0">TZS <?= number_format($todayRevenueTotal, 2) ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-uppercase text-muted mb-3"><?= htmlspecialchars(t('month_revenue')) ?></h6>
                <p class="display-6 mb-0">TZS <?= number_format($monthRevenueTotal, 2) ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-5">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <h5 class="card-title mb-2 mb-md-0"><?= htmlspecialchars(t('month_report')) ?></h5>
            <span class="text-muted"><?= count($monthRecords) ?> records</span>
        </div>
        <div class="table-responsive">
            <table id="reportMonthTable" class="table table-striped table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?= htmlspecialchars(t('product')) ?></th>
                        <th><?= htmlspecialchars(t('quantity')) ?></th>
                        <th><?= htmlspecialchars(t('total')) ?></th>
                        <th><?= htmlspecialchars(t('profit')) ?></th>
                        <th><?= htmlspecialchars(t('date')) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($monthRecords as $sale): ?>
                        <tr>
                            <td><?= htmlspecialchars($sale['id']) ?></td>
                            <td><?= htmlspecialchars($sale['product_name']) ?></td>
                            <td><?= htmlspecialchars($sale['quantity']) ?></td>
                            <td>TZS <?= number_format($sale['total'], 2) ?></td>
                            <td>TZS <?= number_format($sale['profit'], 2) ?></td>
                            <td><?= htmlspecialchars($sale['sale_date']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>