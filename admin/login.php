<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - test.pixel-network.de</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
<div class="login-container">
    <div class="glass-card">
        <div class="login-header">
            <div class="icon-box">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h2 class="mb-0">Admin Login</h2>
        </div>

        <!-- Fehlermeldung nur anzeigen, wenn ?error= vorhanden -->
        <?php if (isset($_GET['error']) && !empty($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                <?= htmlspecialchars(urldecode($_GET['error'])) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Login Formular mit korrekter Validierung -->
        <form method="post" action="process/login_process.php" class="needs-validation" novalidate>
            <div class="mb-4">
                <label class="form-label fw-semibold">Benutzername</label>
                <input type="text" name="username" class="form-control" required>
                <div class="invalid-feedback">Benutzername ist erforderlich</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Passwort</label>
                <input type="password" name="password" class="form-control" required>
                <div class="invalid-feedback">Passwort ist erforderlich</div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Anmelden
            </button>
        </form>
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
