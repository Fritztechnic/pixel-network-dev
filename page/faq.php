<?php
?>

<!DOCTYPE html>
<html lang="de">

<head>
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

        /* FAQ Section */

        #Bewertungen {
            margin: 100px;
        }

        .faq {
            padding: 4rem 2rem;
            margin-top: 45px;
        }

        .faq h2 {
            text-align: center;
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
        }

        .faq h2 span {
            color: var(--primary-color);
        }

        .faq p {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 3rem;
            color: #ccc;
        }

        .faq-grid {
            max-width: 700px;
            margin: 0 auto;
        }

        .faq-item {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 1.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .faq-item:hover {
            transform: translateY(-2px);
        }

        .faq-item h3 {
            margin-bottom: 1rem;
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

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h2 {
            color: var(--primary-color);
            font-size: 2.5em;
            margin-bottom: 15px;
        }

        #second-header {

            color: white;
        }

        .header p {
            color: #777;
            font-size: 1.1em;
        }

        .reviews-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .review-card {
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            flex: 1 1 30%;
            min-width: 300px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 1.5rem;
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(12px);
        }

        .review-title {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .review-text {
            font-style: italic;
            margin-bottom: 25px;
        }

        .review-author {
            font-weight: 500;
            float: right;
        }

        @media (max-width: 768px) {
            .review-card {
                flex: 1 1 100%;
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <input type="checkbox" id="menu-toggle" hidden>
        <div class="container">
            <label for="menu-toggle" class="menu-toggle" id="hamburger">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <line x1="4" y1="7" x2="20" y2="7" class="hamburger-line" />
                    <line x1="4" y1="15" x2="20" y2="15" class="hamburger-line" />
                    <line x1="4" y1="23" x2="20" y2="23" class="hamburger-line" />
                </svg>
            </label>
            <div class="nav-container">
                <a href="../index.php" class="logo">Pixel<span>Network</span></a>
                <div class="nav-menu" id="navMenu">
                    <a href="features.php" class="nav-link">Features</a>
                    <a href="pricing.php" class="nav-link">Preise</a>
                    <a href="faq.php" class="nav-link">FAQ</a>
                    <a href="contact.php" class="nav-link">Kontakt</a>
                </div>
                <div class="auth-buttons">
                    <a href="#" class="btn btn-outline">Login</a>
                    <a href="#" class="btn btn-primary">Jetzt Starten</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- FAQ Section -->
    <section class="faq" id="faq">
        <div class="container">
            <h2>Häufige <span>Fragen</span></h2>
            <p>Hier finden Sie Antworten auf die häufigsten Fragen zu unseren Servern.</p>
            <div class="faq-grid">
                <div class="faq-item">
                    <h3>Wie schnell kann ich einen Server bestellen?</h3>
                    <p>Unsere Server werden innerhalb von Sekunden provisioniert und sind sofort nutzbar.</p>
                </div>
                <div class="faq-item">
                    <h3>Welche Zahlungsmethoden werden akzeptiert?</h3>
                    <p>Wir akzeptieren PayPal, Kreditkarte und Überweisung als Zahlungsmethode.</p>
                </div>
                <div class="faq-item">
                    <h3>Kann ich meinen Server später upgraden?</h3>
                    <p>Ja, Sie können Ihren Server jederzeit ohne Datenverlust upgraden.</p>
                </div>
                <div class="faq-item">
                    <h3>Wie lange ist die Mindestlaufzeit?</h3>
                    <p>Unsere Server haben keine feste Mindestlaufzeit. Sie können monatlich kündigen.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="Bewertungen">
        <div class="header">
        <h2>Was unsere Kunden sagen</h2>
        <p id="second-header">Wir können Ihnen viel versprechen, deshalb lassen wir unsere Kunden für uns sprechen.</p>
    </div>

    <div class="reviews-container">
        <!-- Erste Bewertung -->
        <div class="review-card">
            <h3 class="review-title">Great, fast and affordable!</h3>
            <p class="review-text">"Datalix is a great and affordable hosting provider which exceeded my expectations
                with their fast speeds, responsive support team and just a great community to be in 😊 Good work guys!"
            </p>
            <span class="review-author">Harry W</span>
        </div>

        <!-- Zweite Bewertung -->
        <div class="review-card">
            <h3 class="review-title">Netter Support, Gute Leistung, viele Möglichkeiten</h3>
            <p class="review-text">"Nachdem ich bereits bei mehreren Hostern war habe ich nach Tipp von einem Freund mal
                Datalix ausprobiert. Ich war positiv überrascht, da ich für einen verhältnismäßig niedrigem Preis sowie
                die versprochene Leistung, als auch guten Support mit schnellen Antwortzeiten erhalten habe. Fazit:
                Leistung und Support topp!"</p>
            <span class="review-author">LPTP</span>
        </div>

        <!-- Dritte Bewertung -->
        <div class="review-card">
            <h3 class="review-title">Top! 13/10</h3>
            <p class="review-text">"Alle Server laufen top, ich besitze 1x Webspace und ein KVM Ryzen Server und beide
                laufen Problemos. Auch wenn Anliegen oder Probleme existieren kann man sich Problemlos im Support melden
                und es wird einem sofort weitergeholfen. Unglaublich!"</p>
            <span class="review-author">Marc</span>
        </div>

        <!-- Vierte Bewertung -->
        <div class="review-card">
            <h3 class="review-title">Great company for all you VPS needs and...</h3>
            <p class="review-text">"Great company for all you VPS needs and more, with great prices. Support is fast to
                respond and available in both german and english which is nice."</p>
            <span class="review-author">Arek</span>
        </div>

        <!-- Fünfte Bewertung -->
        <div class="review-card">
            <h3 class="review-title">Sehr guter Hoster!</h3>
            <p class="review-text">"Ich kanns euch nur empfehlen. Das Design vom Dashboard ist sehr übersichtlich und
                ihr könnt dort sehr gut eure Server verwalten. Außerdem finde ich den Support im Discord sehr schnell
                und vor allem sehr freundlich. Ich empfehle euch mal vorbei zuschauen die Preise sind aktuell dort sehr
                günstig im vergleich zu manchen anderen Hostern."</p>
            <span class="review-author">Matteobifi</span>
        </div>

        <!-- Sechste Bewertung -->
        <div class="review-card">
            <h3 class="review-title">Guter Support + Qualität</h3>
            <p class="review-text">"Sehr schneller und kompetenter Support. Außerdem laufen die Server gut und ohne
                Probleme! Die günstigen Preise haben mich am Anfang zweifeln lassen aber man bekommt wirklich sehr sehr
                gute Qualität trotz der günstigen Preise!"</p>
            <span class="review-author">DJCool</span>
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
                        <input type="email" placeholder="Ihre E-Mail-Adresse" />
                        <button type="submit" class="btn btn-primary btn-sm">Abonnieren</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {new Date().getFullYear()} Pixel Network. Alle Rechte vorbehalten.
            </div>
        </div>
    </footer>
</body>

</html>
