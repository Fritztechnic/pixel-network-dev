<!DOCTYPE html>
<html lang="de">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Network - Hochwertige Server</title>
    <style>
        :root {
            --primary-color: #EC4899;
            --primary-hover: #DB2777;
            --secondary-color: #8B5CF6;
            --admin-color: #8B5CF6;
            --user-color: #10B981;
            --background-gradient: linear-gradient(135deg, #0F172A, #1E293B, #334155);
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --card-hover: rgba(255, 255, 255, 0.08);
            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 15px rgba(0, 0, 0, 0.2);
            --shadow-lg: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background-gradient);
            color: #fff;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
            background: rgba(15, 20, 25, 0.98);
            backdrop-filter: blur(15px);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: relative;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .logo span {
            color: var(--primary-color);
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
            flex: 1;
            justify-content: center;
        }

        .nav-link {
            color: white;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            transition: 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
            display: inline-block;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(236, 72, 153, 0.4);
        }

        .btn-outline {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        .btn-outline:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        /* Hamburger Menu */
        .menu-toggle {
            display: none;
            cursor: pointer;
            width: 24px;
            height: 24px;
            position: absolute;
            right: 2rem;
            top: 1.5rem;
        }

        .menu-toggle path {
            stroke: var(--primary-color);
            stroke-width: 2;
            stroke-linecap: round;
            transition: all 0.3s ease;
        }

        /* Hide checkbox */
        #menu-toggle {
            display: none;
        }

        /* Show menu when checkbox is checked */
        #menu-toggle:checked~.nav-container .nav-menu {
            display: flex;
            flex-direction: column;
            background: rgba(15, 20, 25, 0.98);
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            padding: 1rem 2rem;
            z-index: 1000;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Change hamburger to X */
        #menu-toggle:checked+.nav-container .menu-toggle line:nth-child(1) {
            transform: rotate(45deg);
            transform-origin: center;
            margin-top: 6px;
        }

        #menu-toggle:checked+.nav-container .menu-toggle line:nth-child(2) {
            opacity: 0;
        }

        #menu-toggle:checked+.nav-container .menu-toggle line:nth-child(3) {
            transform: rotate(-45deg);
            transform-origin: center;
            margin-top: -6px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-menu {
                display: none;
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
                padding: 1rem 0;
            }

            .auth-buttons {
                width: 100%;
                justify-content: flex-end;
                margin-top: 0.5rem;
            }

            .menu-toggle {
                display: block;
            }
        }

        /* Pricing Section */
        .pricing {
            padding: 4rem 2rem;
            background: linear-gradient(180deg, #1E293B, #334155);
            margin-top: 25px;
        }

        .pricing h2 {
            text-align: center;
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
        }

        .pricing h2 span {
            color: var(--primary-color);
        }

        .pricing p {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 3rem;
            color: #ccc;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            position: relative;
        }

        .pricing-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 1.5rem;
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(12px);
        }

        .pricing-card.highlighted {
            border: 2px solid var(--primary-color);
            transform: scale(1.05);
        }

        .pricing-card.highlighted:hover {
            transform: scale(1.07);
        }

        .pricing-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .pricing-card .price {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .pricing-card .price span {
            font-size: 1.25rem;
            color: #ccc;
        }

        .pricing-card ul {
            margin-bottom: 2rem;
        }

        .pricing-card ul li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .pricing-card ul li svg {
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .pricing-bottom {
            text-align: center;
            margin-top: 2rem;
            color: #ccc;
        }

        /*Vorteile*/

        #section2 {
            margin: 15px;
        }

        .header {
            text-align: center;
            padding: 3rem 0;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .header p {
            color: #ccc;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            padding: 2rem 0;
        }

        .benefit-item {
            text-align: center;
            padding: 1rem;

            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 1.5rem;
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(12px);
        }

        .benefit-item:hover {
            transform: translateY(-5px);
        }

        .benefit-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .benefit-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 0 0 0.5rem;
            color: #fff;
        }

        .benefit-description {
            color: #ccc;
            text-align: center;
        }

        .support {
            background-image: url('headphones.png');
        }

        .level-system {
            background-image: url('levels.png');
        }

        .prepaid {
            background-image: url('money.png');
        }

        .flexibel {
            background-image: url('sliders.png');
        }

        .sofort-online {
            background-image: url('clock.png');
        }

        .ddos-schutz {
            background-image: url('shield.png');
        }

        @media (max-width: 768px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Footer */
        .footer {
            background: rgba(15, 23, 42, 0.9);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 3rem 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .footer-description {
            color: #ccc;
            margin-bottom: 1.5rem;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            color: var(--primary-color);
        }

        .footer-contact li {
            display: flex;
            align-items: start;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .footer-contact svg {
            flex-shrink: 0;
            margin-top: 2px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .footer-links a {
            color: #ccc;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .footer-newsletter input {
            width: 100%;
            padding: 0.6rem 1rem;
            border-radius: 1rem;
            border: none;
            background-color: rgba(255, 255, 255, 0.08);
            color: white;
            margin-bottom: 1rem;
        }

        .footer-newsletter button {
            width: 100%;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }

        .footer-bottom {
            text-align: center;
            color: #666;
            margin-top: 2rem;
            font-size: 0.875rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <input type="checkbox" id="menu-toggle" hidden="">
        <div class="container">
            <label for="menu-toggle" class="menu-toggle" id="hamburger">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <line x1="4" y1="7" x2="20" y2="7" class="hamburger-line"></line>
                    <line x1="4" y1="15" x2="20" y2="15" class="hamburger-line"></line>
                    <line x1="4" y1="23" x2="20" y2="23" class="hamburger-line"></line>
                </svg>
            </label>
            <div class="nav-container">
                <a href="https://pixel-network.de/index.php" class="logo">Pixel<span>Network</span></a>
                <div class="nav-menu" id="navMenu">
                    <a href="https://pixel-network.de/page/features.php" class="nav-link">Features</a>
                    <a href="https://pixel-network.de/page/pricing.php" class="nav-link">Preise</a>
                    <a href="https://pixel-network.de/page/faq.php" class="nav-link">FAQ</a>
                    <a href="https://pixel-network.de/page/contact.php" class="nav-link">Kontakt</a>
                </div>
                <div class="auth-buttons">
                    <a href="#" class="btn btn-outline">Login</a>
                    <a href="#" class="btn btn-primary">Jetzt Starten</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Pricing Section -->
    <section class="pricing" id="pricing">
        <div class="container">
            <h2>Unsere <span>Preise</span></h2>
            <p>Flexible Tarife für jeden Bedarf. Keine versteckten Kosten, monatliche Abrechnung.</p>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3>Starter</h3>
                    <div class="price">
                        <span>9.99€</span><span>/Monat</span>
                    </div>
                    <ul>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            1 vCPU
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            1 GB RAM
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            25 GB SSD Speicher
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            1 TB Traffic
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            1 IPv4 Adresse
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary">Jetzt Buchen</a>
                </div>
                <div class="pricing-card highlighted">
                    <h3>Pro</h3>
                    <div class="price">
                        <span>19.99€</span><span>/Monat</span>
                    </div>
                    <ul>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            2 vCPU
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            2 GB RAM
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            50 GB SSD Speicher
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            2 TB Traffic
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            2 IPv4 Adressen
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary">Jetzt Buchen</a>
                </div>
                <div class="pricing-card">
                    <h3>Premium</h3>
                    <div class="price">
                        <span>39.99€</span><span>/Monat</span>
                    </div>
                    <ul>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            4 vCPU
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            4 GB RAM
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            100 GB SSD Speicher
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            5 TB Traffic
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EC4899"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            3 IPv4 Adressen
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary">Jetzt Buchen</a>
                </div>
            </div>
            <div class="pricing-bottom">
                Alle Preise inklusive MwSt. | Monatliche Kündigung möglich | Sofort einsetzbar
            </div>
        </div>
    </section>

    <section id="section2">
        <div class="header">
            <h1>VORTEILE, DIE SICH SEHEN LASSEN KÖNNEN</h1>
            <p>Als Pixel-Network Kunde profitierst du nachhaltig von unschlagbaren Vorteilen.</p>
        </div>

        <div class="benefits-grid">
            <div class="benefit-item">
                <div class="benefit-icon support"></div>
                <h3 class="benefit-title">Support</h3>
                <p class="benefit-description">Unser fachkundiges Support Team steht Dir unter verschiedenen
                    Kontaktmöglichkeiten mit Rat und Tat zur Verfügung.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon level-system"></div>
                <h3 class="benefit-title">Prepaid</h3>
                <p class="benefit-description">Wir bieten Dir ein sicheres, unkompliziertes und transparentes Prepaid
                    System, in dem Dich keine versteckten Kosten erwarten.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon prepaid"></div>
                <h3 class="benefit-title">Prepaid</h3>
                <p class="benefit-description">Wir bieten Dir ein sicheres, unkompliziertes und transparentes Prepaid
                    System, in dem Dich keine versteckten Kosten erwarten.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon flexibel"></div>
                <h3 class="benefit-title">Flexibel</h3>
                <p class="benefit-description">Wir bieten Dir die Möglichkeit jederzeit Dein gemietetes Paket und somit
                    die
                    Leistung deines Minecraft Servers zu verändern.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon sofort-online"></div>
                <h3 class="benefit-title">Sofort online</h3>
                <p class="benefit-description">Nach Zahlungseingang wird Dein gemieteter Minecraft Server durch unser
                    automatisiertes System innerhalb von wenigen Sekunden installiert.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon ddos-schutz"></div>
                <h3 class="benefit-title">DDoS Schutz</h3>
                <p class="benefit-description">Dein Minecraft Server wird Tag und Nacht durch unseren DDoS Schutz sicher
                    und
                    zuverlässig vor Angreifern geschützt.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand">Pixel<span>Network</span></div>
                    <p class="footer-description">Moderne Serverlösungen für Unternehmen und Privatkunden.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                </path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="footer-heading">Kontakt</h3>
                    <ul class="footer-contact">
                        <li>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Musterstraße 123, 12345 Musterstadt
                        </li>
                        <li>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                            +49 123 456789
                        </li>
                        <li>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            info@pixelnetwork.de
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-heading">Rechtliches</h3>
                    <ul class="footer-links">
                        <li><a href="#">Impressum</a></li>
                        <li><a href="#">Datenschutz</a></li>
                        <li><a href="#">AGB</a></li>
                        <li><a href="#">Widerrufsrecht</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-heading">Newsletter</h3>
                    <p class="footer-description">Bleiben Sie über unsere Angebote informiert.</p>
                    <form class="footer-newsletter">
                        <input type="email" placeholder="Ihre E-Mail-Adresse">
                        <button type="submit" class="btn btn-primary btn-sm">Abonnieren</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                © {new Date().getFullYear()} Pixel Network. Alle Rechte vorbehalten.
            </div>
        </div>
    </footer>


</body>

</html>
