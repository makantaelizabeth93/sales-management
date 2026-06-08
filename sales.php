<?php
// Protect page and ensure the user is logged in
require_once __DIR__ . '/includes/auth.php';
require_login();

// Load products for the sales form
$products = $pdo->query('SELECT id, name, sale_price, cost_price, stock FROM products ORDER BY name ASC')->fetchAll();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;
    $quantity = $_POST['quantity'] ?? null;

    if (!$product_id || !$quantity || !is_numeric($quantity) || $quantity <= 0) {
        $error = t('select_product_invalid');
    } else {
        $productStmt = $pdo->prepare('SELECT * FROM products WHERE id = ? LIMIT 1');
        $productStmt->execute([$product_id]);
        $product = $productStmt->fetch();

        if (!$product) {
            $error = t('product_not_found');
        } elseif ($quantity > $product['stock']) {
            $error = t('out_of_stock');
        } else {
            $sale_price = $product['sale_price'];
            $cost_price = $product['cost_price'];
            $total = $quantity * $sale_price;
            $profit = $quantity * ($sale_price - $cost_price);

            $pdo->beginTransaction();
            try {
                $saleStmt = $pdo->prepare('INSERT INTO sales (product_id, quantity, sale_price, total, profit, sale_date, created_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())');
                $saleStmt->execute([$product_id, $quantity, $sale_price, $total, $profit]);

                $updateStmt = $pdo->prepare('UPDATE products SET stock = stock - ? WHERE id = ?');
                $updateStmt->execute([$quantity, $product_id]);

                $pdo->commit();
                set_flash('success', t('sale_saved'));
                header('Location: sales.php');
                exit;
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = t('sale_save_error');
            }
        }
    }
}

$sales = $pdo->query('SELECT s.id, p.name AS product_name, s.quantity, s.sale_price, s.total, s.profit, s.sale_date FROM sales s JOIN products p ON s.product_id = p.id ORDER BY s.sale_date DESC LIMIT 20')->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0"><?= htmlspecialchars(t('sales_title')) ?></h1>
        <p class="text-muted mb-0"><?= htmlspecialchars(t('sales_description')) ?></p>
    </div>
</div>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" class="row g-3">
            <div class="col-md-5">
                <label class="form-label"><?= htmlspecialchars(t('choose_product')) ?></label>
                <select id="product_select" name="product_id" class="form-select" required>
                    <option value=""><?= htmlspecialchars(t('choose_product')) ?></option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['id'] ?>" data-price="<?= $product['sale_price'] ?>"><?= htmlspecialchars($product['name']) ?> (Stock: <?= htmlspecialchars($product['stock']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label"><?= htmlspecialchars(t('price')) ?></label>
                <input id="sale_price" type="text" class="form-control" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label"><?= htmlspecialchars(t('quantity')) ?></label>
                <input id="quantity" type="number" name="quantity" class="form-control" min="1" value="1" required>
            </div>
            <div class="col-md-3">
                <label class="form-label"><?= htmlspecialchars(t('total')) ?></label>
                <input id="total" type="text" class="form-control" readonly>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-success"><?= htmlspecialchars(t('save_sale')) ?></button>
            </div>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3"><?= htmlspecialchars(t('recent_sales')) ?></h5>
        <div class="table-responsive">
            <table id="salesTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?= htmlspecialchars(t('product')) ?></th>
                        <th><?= htmlspecialchars(t('quantity')) ?></th>
                        <th><?= htmlspecialchars(t('price')) ?></th>
                        <th><?= htmlspecialchars(t('total')) ?></th>
                        <th><?= htmlspecialchars(t('profit')) ?></th>
                        <th><?= htmlspecialchars(t('date')) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale): ?>
                        <tr>
                            <td><?= htmlspecialchars($sale['id']) ?></td>
                            <td><?= htmlspecialchars($sale['product_name']) ?></td>
                            <td><?= htmlspecialchars($sale['quantity']) ?></td>
                            <td>TZS <?= number_format($sale['sale_price'], 2) ?></td>
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