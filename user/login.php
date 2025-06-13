<?php
session_start();
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login - test.pixel-network.de</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body class="bg-dark">
<div class="login-container d-flex align-items-center justify-content-center min-vh-100">
    <div class="glass-card p-4 p-md-5 shadow-sm" style="max-width: 400px; width: 100%;">
        <div class="login-header text-center mb-4">
            <div class="icon-box mb-3 mx-auto">
                <i class="bi bi-person-circle"></i>
            </div>
            <h2 class="mb-0 fw-bold">Kundenlogin</h2>
            <p class="text-muted small mt-1">Geben Sie Ihre Zugangsdaten ein</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="process/login_process.php" method="post" class="needs-validation" novalidate>
            <div class="mb-4">
                <label class="form-label fw-semibold">Benutzername</label>
                <div class="input-group has-validation">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-person-fill text-muted"></i>
                    </span>
                    <input type="text" id="username" name="username" class="form-control border-start-0" required>
                    <div class="invalid-feedback">Benutzername ist erforderlich</div>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Passwort</label>
                <div class="input-group has-validation">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-lock-fill text-muted"></i>
                    </span>
                    <input type="password" id="password" name="password" class="form-control border-start-0" required>
                    <div class="invalid-feedback">Passwort ist erforderlich</div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Einloggen
            </button>
        </form>
        <div class="text-center mt-3">
            <p class="small mb-0">Noch keinen Account?
                <a href="register.php" class="text-decoration-none" style="color: var(--primary-color);">
                    Registriere dich hier
                </a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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