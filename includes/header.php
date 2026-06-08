<?php
// Ensure session is started for page access and flash messages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="<?= htmlspecialchars(current_lang()) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars(t('app_title')) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css" rel="stylesheet">
    <!-- Font Awesome for hamburger menu icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Main sidebar navigation -->
    <aside class="border-end bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-light"><?= htmlspecialchars(t('app_title')) ?></div>
        <div class="list-group list-group-flush">
            <a href="dashboard.php" class="list-group-item list-group-item-action <?= $currentPage === 'dashboard.php' ? 'active' : '' ?>"><?= htmlspecialchars(t('dashboard')) ?></a>
            <a href="products.php" class="list-group-item list-group-item-action <?= in_array($currentPage, ['products.php','add_product.php','edit_product.php']) ? 'active' : '' ?>"><?= htmlspecialchars(t('products')) ?></a>
            <a href="sales.php" class="list-group-item list-group-item-action <?= $currentPage === 'sales.php' ? 'active' : '' ?>"><?= htmlspecialchars(t('sales')) ?></a>
            <a href="reports.php" class="list-group-item list-group-item-action <?= $currentPage === 'reports.php' ? 'active' : '' ?>"><?= htmlspecialchars(t('reports')) ?></a>
            <a href="logout.php" class="list-group-item list-group-item-action"><?= htmlspecialchars(t('logout')) ?></a>
        </div>
    </aside>
    <div id="page-content-wrapper" class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <!-- Hamburger menu button - only visible on mobile -->
                <button class="btn btn-link text-dark d-lg-none" id="sidebarToggle" aria-label="Toggle menu" style="font-size: 1.5rem; border: none; padding: 0; margin-right: 1rem;" title="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
                <!-- Page title for mobile view -->
                <span class="navbar-brand d-lg-none">Sales System</span>
                <div class="d-flex align-items-center ms-auto">
                    <span class="me-3"><?= htmlspecialchars(t('logged_in_as')) ?> <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Guest') ?></strong></span>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="languageMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= htmlspecialchars(t('language')) ?>: <?= strtoupper(htmlspecialchars(current_lang())) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageMenuButton">
                            <li><a class="dropdown-item<?= current_lang() === 'en' ? ' active' : '' ?>" href="<?= htmlspecialchars(language_switch_url('en')) ?>"><?= htmlspecialchars(t('english')) ?></a></li>
                            <li><a class="dropdown-item<?= current_lang() === 'sw' ? ' active' : '' ?>" href="<?= htmlspecialchars(language_switch_url('sw')) ?>"><?= htmlspecialchars(t('swahili')) ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid px-4 py-4">
            <?php flash_message(); ?>
