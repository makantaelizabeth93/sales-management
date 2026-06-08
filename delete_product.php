<?php
// Protect page and ensure the user is logged in
require_once __DIR__ . '/includes/auth.php';
require_login();

// Validate product ID before deleting
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header('Location: products.php');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
$stmt->execute([$id]);
set_flash('success', t('product_deleted'));
header('Location: products.php');
exit;
