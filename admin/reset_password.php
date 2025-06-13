<?php
session_start();
require '../global_process/db_connect.php';

// Prüfen, ob Admin eingeloggt ist
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// user_id aus URL oder POST holen
$user_id = intval($_GET['user_id'] ?? $_POST['user_id'] ?? 0);

// Nutzerdaten aus DB holen
if ($user_id <= 0) {
    header("Location: dashboard.php?error=Error 12, Ungültige Benutzer-ID.");
    exit();
}

$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: dashboard.php?error=Benutzer nicht gefunden.");
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Passwort zurücksetzen - pixel-network.de</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
<div class="login-container">
    <div class="glass-card">
        <div class="login-header">
            <div class="icon-box">
                <i class="bi bi-key-fill"></i>
            </div>
            <h2 class="mb-0">Passwort zurücksetzen</h2>
            <p class="text-muted mt-2">für <?= htmlspecialchars($user['username']) ?></p>
        </div>

        <!-- Fehlermeldung -->
        <?php if (isset($_GET['error']) && !empty($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                <?= htmlspecialchars(urldecode($_GET['error'])) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form method="post" action="process/reset_password_process.php" class="needs-validation" novalidate>
            <input type="hidden" name="user_id" value="<?= $user_id ?>">

            <div class="mb-4">
                <label class="form-label fw-semibold">Neues Passwort</label>
                <input type="password" name="new_password" class="form-control" required minlength="8">
                <div class="invalid-feedback">Bitte mindestens 8 Zeichen eingeben</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Passwort bestätigen</label>
                <input type="password" name="confirm_password" class="form-control" required>
                <div class="invalid-feedback">Passwort muss übereinstimmen</div>
            </div>

            <button type="submit" class="btn btn-warning btn-lg w-100 mt-3">
                <i class="bi bi-arrow-clockwise me-2"></i>Passwort zurücksetzen
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="dashboard.php" class="text-white text-decoration-none">
                <i class="bi bi-arrow-left-circle me-1"></i>Zurück zum Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Formularvalidierung -->
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>