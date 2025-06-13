<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kunden-Dashboard - test.pixel-network.de</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-lg mb-4">
    <div class="container-fluid px-4">
        <!-- Logo/Brand mit Icon -->
        <a class="navbar-brand d-flex align-items-center" href="#" style="color: var(--primary-color);">
            <i class="bi bi-server me-2" style="font-size: 1.5rem;"></i>
            <span class="fw-bold">Kunden-Dashboard</span>
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
                        <span class="text-white"><?= htmlspecialchars($_SESSION['username']) ?></span>
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
    <!-- Dashboard Header -->
    <div class="d-flex flex-column dashboard-header mb-5">
        <div class="d-flex align-items-center">
            <div class="icon-box me-3">
                <i class="bi bi-server"></i>
            </div>
            <div>
                <h1 class="display-6 mb-0">Server-Übersicht</h1>
                <p class="text-muted mb-0">Willkommen in Ihrem Kunden-Dashboard</p>
            </div>
        </div>
    </div>

    <!-- Willkommenskarte -->
    <div class="glass-card p-4 mb-5 shadow-sm">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-person-circle me-2" style="color: var(--primary-color);"></i>
            <h2 class="mb-0 fw-bold">Willkommen, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-12">
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <div>
                        Hier finden Sie alle wichtigen Informationen zu Ihren Servern und Services.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Server-Daten Platzhalter -->
    <div class="glass-card p-4 shadow-sm">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-hdd-network me-2" style="color: var(--primary-color);"></i>
            <h2 class="mb-0 fw-bold">Ihre Server</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-striped align-middle mb-0">
                <thead>
                <tr>
                    <th>Servername</th>
                    <th>Status</th>
                    <th>IP-Adresse</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="4" class="text-center py-4">
                        <i class="bi bi-hdd-x display-6 text-muted mb-3"></i>
                        <p class="mb-0">Keine Server gefunden</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Back to Top Button -->
<a href="#" class="back-to-top" id="backToTop" title="Nach oben">
    <i class="bi bi-arrow-up-short" style="font-size: 1.5rem;"></i>
</a>

<!-- Footer -->
<footer class="container-fluid mt-5 py-4" style="background: var(--glass-bg); border-top: 1px solid var(--glass-border);">
    <div class="container text-center text-muted">
        <p class="mb-0">&copy; 2025 Meine Website. Alle Rechte vorbehalten.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Formularvalidierung & Interaktivität -->
<script>
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