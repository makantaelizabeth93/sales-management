<?php
// Load authentication helper, database connection, and translation support
require_once __DIR__ . '/includes/auth.php';

// Redirect logged-in users to the dashboard
if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = t('fill_all_fields');
    } else {
        $stmt = $pdo->prepare('SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: dashboard.php');
            exit;
        }
        $error = t('incorrect_credentials');
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sales Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="d-flex align-items-center bg-light" style="min-height:100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="<?= htmlspecialchars(language_switch_url('en')) ?>" class="btn btn-sm btn-outline-secondary me-2 <?= current_lang() === 'en' ? 'active' : '' ?>"><?= htmlspecialchars(t('english')) ?></a>
                            <a href="<?= htmlspecialchars(language_switch_url('sw')) ?>" class="btn btn-sm btn-outline-secondary <?= current_lang() === 'sw' ? 'active' : '' ?>"><?= htmlspecialchars(t('swahili')) ?></a>
                        </div>
                        <h4 class="card-title mb-3"><?= htmlspecialchars(t('login_title')) ?></h4>
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <form method="post" novalidate>
                            <div class="mb-3">
                                <label class="form-label"><?= htmlspecialchars(t('username')) ?></label>
                                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?= htmlspecialchars(t('password')) ?></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100"><?= htmlspecialchars(t('sign_in')) ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>