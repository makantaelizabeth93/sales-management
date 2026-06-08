<?php
// Protect page and ensure the user is logged in
require_once __DIR__ . '/includes/auth.php';
require_login();

// Load product list to display in the products table
$products = $pdo->query('SELECT * FROM products ORDER BY id DESC')->fetchAll();
require_once __DIR__ . '/includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0"><?= htmlspecialchars(t('products')) ?></h1>
        <p class="text-muted mb-0"><?= htmlspecialchars(t('product_overview')) ?></p>
    </div>
    <a href="add_product.php" class="btn btn-success"><?= htmlspecialchars(t('add_product')) ?></a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table id="productTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?= htmlspecialchars(t('name')) ?></th>
                        <th><?= htmlspecialchars(t('description')) ?></th>
                        <th><?= htmlspecialchars(t('cost_price')) ?></th>
                        <th><?= htmlspecialchars(t('sale_price')) ?></th>
                        <th><?= htmlspecialchars(t('stock')) ?></th>
                        <th><?= htmlspecialchars(t('actions')) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                            <td>TZS <?= number_format($product['cost_price'], 2) ?></td>
                            <td>TZS <?= number_format($product['sale_price'], 2) ?></td>
                            <td><?= number_format($product['stock']) ?></td>
                            <td>
                                <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-primary"><?= htmlspecialchars(t('edit_product')) ?></a>
                                <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-danger delete-product"><?= htmlspecialchars(t('delete')) ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>