<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require '../global_process/db_connect.php';

// Fehler-/Erfolgsnachrichten verarbeiten
$error = isset($_GET['error']) ? htmlspecialchars(urldecode($_GET['error'])) : '';
$success = isset($_GET['success']) ? "Benutzer erfolgreich erstellt!" : '';

// Benutzerdaten abrufen
try {
    $stmt = $pdo->query("SELECT id, username, email, is_admin FROM users ORDER BY is_admin DESC, username");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Fehler beim Laden der Benutzer: " . $e->getMessage();
    $users = [];
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - test.pixel-network.de</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-lg mb-4">
    <div class="container-fluid px-4">
        <!-- Logo/Brand mit Icon -->
        <a class="navbar-brand d-flex align-items-center" href="#" style="color: var(--primary-color);">
            <i class="bi bi-shield-lock-fill me-2" style="font-size: 1.5rem;"></i>
            <span class="fw-bold">Admin Dashboard</span>
        </a>

        <!-- Mobile Toggle Button -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
            style="border-color: var(--primary-color);"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links & Logout Button -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3">
                <!-- User Info Dropdown -->
                <li class="nav-item dropdown d-none d-md-block">
                    <a
                        class="nav-link dropdown-toggle d-flex align-items-center"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="bi bi-person-circle me-2" style="color: var(--primary-color);"></i>
                        <span class="text-white">Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="background: var(--glass-bg); border: 1px solid var(--glass-border);">
                        <li><a class="dropdown-item text-white" href="#"><i class="bi bi-gear me-2"></i>Einstellungen</a></li>
                        <li><hr class="dropdown-divider" style="border-color: var(--glass-border);"></li>
                        <li><a class="dropdown-item text-danger" href="process/logout_process.php"><i class="bi bi-box-arrow-right me-2"></i>Abmelden</a></li>
                    </ul>
                </li>

                <!-- Mobile Friendly Logout Button -->
                <li class="nav-item d-md-none">
                    <a class="nav-link btn btn-primary w-100" href="process/logout_process.php">
                        <i class="bi bi-box-arrow-right me-2"></i>Abmelden
                    </a>
                </li>

                <!-- Desktop Logout Button -->
                <li class="nav-item d-none d-md-block">
                    <a
                        class="nav-link btn btn-primary px-3 py-2"
                        href="process/logout_process.php"
                        style="background-color: var(--primary-color); border-color: var(--primary-color);"
                    >
                        <i class="bi bi-box-arrow-right me-2"></i>Abmelden
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="container py-5" style="max-width: 1200px;">
    <!-- Modern Admin Dashboard, Glassmorphism, Pink Accent -->
    <!-- Erfolgs-/Fehlermeldung -->
    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i><?= $success ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-1"></i><?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Dashboard Header -->
    <div class="d-flex flex-column dashboard-header mb-5">
        <div class="d-flex align-items-center">
            <div class="icon-box me-3">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <h1 class="display-6 mb-0">Benutzerverwaltung</h1>
                <p class="text-muted mb-0">Verwalten Sie hier alle Benutzerkonten und Rechte</p>
            </div>
        </div>
    </div>

    <!-- Neuen Benutzer hinzufügen -->
    <div class="glass-card p-4 mb-5 shadow-sm">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-person-plus-fill me-2" style="color: var(--primary-color);"></i>
            <h2 class="mb-0 fw-bold">Neuen Benutzer erstellen</h2>
        </div>
        <form method="post" action="process/add_user_process.php" class="needs-validation" novalidate>
            <div class="row g-4 form-row">
                <!-- Benutzername -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Benutzername</label>
                    <input type="text" name="username" class="form-control" required>
                    <div class="invalid-feedback">Benutzername ist erforderlich</div>
                </div>

                <!-- E-Mail -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">E-Mail-Adresse</label>
                    <input type="email" name="email" class="form-control" required>
                    <div class="invalid-feedback">Gültige E-Mail ist erforderlich</div>
                </div>

                <!-- Passwort -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Passwort</label>
                    <input type="password" name="password" class="form-control" required minlength="12">
                    <div class="invalid-feedback">Mindestens 12 Zeichen erforderlich</div>
                    <div class="password-strength-meter mt-2">
                        <span></span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4 pt-3">
                <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto">
                    <i class="bi bi-person-plus me-2"></i>Benutzer erstellen
                </button>
            </div>
        </form>
    </div>

    <!-- Benutzertabelle -->
    <div class="glass-card p-4 shadow-sm">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-person-lines-fill me-2" style="color: var(--primary-color);"></i>
            <h2 class="mb-0 fw-bold">Benutzerverwaltung</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-striped align-middle mb-0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Benutzername</th>
                    <th>E-Mail</th>
                    <th>Rolle</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="bi bi-person-dash display-6 text-muted mb-3"></i>
                            <p class="mb-0">Keine Benutzer gefunden</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="user-card">
                            <td><?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                        <span class="badge <?= $user['is_admin'] ? 'badge-admin' : 'badge-user' ?> rounded-pill px-3 py-2">
                                            <?= $user['is_admin'] ? 'Admin' : 'Benutzer' ?>
                                        </span>
                            </td>
                            <td class="text-nowrap">
                                <?php if ($user['is_admin']): ?>
                                    <a href="process/admin_toggle.php?id=<?= $user['id'] ?>&action=demote"
                                       class="btn btn-outline-secondary btn-sm me-2"
                                       onclick="return confirm('Admin-Rechte entfernen?')">
                                        <i class="bi bi-shield-minus me-1"></i>Rechte entfernen
                                    </a>
                                <?php else: ?>
                                    <a href="process/admin_toggle.php?id=<?= $user['id'] ?>&action=promote"
                                       class="btn btn-outline-admin btn-sm me-2"
                                       onclick="return confirm('Zum Admin machen?')">
                                        <i class="bi bi-shield-check me-1"></i>Admin-Recht geben
                                    </a>
                                <?php endif; ?>

                                <a href="reset_password.php?user_id=<?= $user['id'] ?>"
                                   class="btn btn-outline-warning btn-sm me-2">
                                    <i class="bi bi-key me-1"></i>Zurücksetzen
                                </a>

                                <a href="process/delete_user_process.php?id=<?= $user['id'] ?>"
                                   class="btn btn-outline-danger btn-sm"
                                   onclick="return confirm('Benutzer löschen?')">
                                    <i class="bi bi-trash me-1"></i>Löschen
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Back to Top Button -->
<a href="#" class="back-to-top" id="backToTop" title="Nach oben">
    <i class="bi bi-arrow-up-short" style="font-size: 1.5rem;"></i>
</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Formularvalidierung & Interaktivität -->
<script>
    // Passwortstärken-Indikator
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.querySelector('input[name="password"]');
        const strengthMeter = document.querySelector('.password-strength-meter span');

        if (passwordInput && strengthMeter) {
            passwordInput.addEventListener('input', function () {
                const password = this.value;
                let strength = 0;

                // Länge prüfen
                if (password.length >= 12) strength += 20;
                if (password.length >= 16) strength += 10;

                // Kleinbuchstaben
                if (/[a-z]/.test(password)) strength += 20;

                // Großbuchstaben
                if (/[A-Z]/.test(password)) strength += 20;

                // Zahlen
                if (/[0-9]/.test(password)) strength += 20;

                // Sonderzeichen
                if (/[^A-Za-z0-9]/.test(password)) strength += 10;

                // Farbe basierend auf Stärke
                let width = strength;
                let color = '#EF4444'; // Rot
                if (strength >= 60) color = '#F59E0B'; // Gelb
                if (strength >= 80) color = '#10B981'; // Grün

                strengthMeter.style.width = width + '%';
                strengthMeter.style.backgroundColor = color;
            });
        }
    });

    // Formularvalidierung
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

    // Auto-hide alerts nach 5 Sekunden
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            bootstrap.Alert.getOrCreateInstance(alert).close();
        });
    }, 5000);

    // Back to Top Button anzeigen wenn gescrollt wird
    window.addEventListener('scroll', function () {
        const backToTop = document.getElementById('backToTop');
        if (window.pageYOffset > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });
</script>
</body>
</html>
