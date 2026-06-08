<?php
// Start session and load database connection
session_start();

// Load language helper so UI text can be translated across the system
require_once __DIR__ . '/lang.php';
require_once __DIR__ . '/../config/db.php';

// Redirect unauthenticated users to the login page
function require_login() {
    if (empty($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }
}

function current_user() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'role' => $_SESSION['role'] ?? null,
    ];
}

// Display a one-time flash message from the session
function flash_message() {
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        echo '<div class="alert alert-' . htmlspecialchars($flash['type']) . ' alert-dismissible fade show" role="alert">';
        echo htmlspecialchars($flash['text']);
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['flash']);
    }
}

function set_flash($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'text' => $message,
    ];
}
