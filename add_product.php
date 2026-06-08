<?php
// Protect page and ensure the user is logged in
require_once __DIR__ . '/includes/auth.php';
require_login();

// Form values initialization
$name = '';
$description = '';
$cost_price = '';
$sale_price = '';
$stock = '';
$error = '';

// Process the form submission for adding a new product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $cost_price = trim($_POST['cost_price'] ?? '');
    $sale_price = trim($_POST['sale_price'] ?? '');
    $stock = trim($_POST['stock'] ?? '');

    if ($name === '' || $cost_price === '' || $sale_price === '' || $stock === '') {
        $error = t('all_fields_required');
    } elseif (!is_numeric($cost_price) || !is_numeric($sale_price) || !is_numeric($stock)) {
        $error = t('numeric_values_required');
    } else {
        // Insert the new product into the database
        $stmt = $pdo->prepare('INSERT INTO products (name, description, cost_price, sale_price, stock, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
        $stmt->execute([$name, $description, $cost_price, $sale_price, $stock]);
        set_flash('success', t('product_added'));
        header('Location: products.php');
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<h1 class="mb-4"><?= htmlspecialchars(t('add_new_product')) ?></h1>
<div class="card shadow-sm">
    <div class="card-body">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label"><?= htmlspecialchars(t('product_name')) ?></label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><?= htmlspecialchars(t('description')) ?></label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($description) ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?= htmlspecialchars(t('cost_price')) ?></label>
                    <input type="text" name="cost_price" class="form-control" value="<?= htmlspecialchars($cost_price) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?= htmlspecialchars(t('sale_price')) ?></label>
                    <input type="text" name="sale_price" class="form-control" value="<?= htmlspecialchars($sale_price) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><?= htmlspecialchars(t('stock')) ?></label>
                    <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars($stock) ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><?= htmlspecialchars(t('save_product')) ?></button>
            <a href="products.php" class="btn btn-secondary"><?= htmlspecialchars(t('back')) ?></a>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>