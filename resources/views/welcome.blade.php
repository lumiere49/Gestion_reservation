<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VLIFE - Réservation de services</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --vlife-bordeaux: #8B0038;
            --vlife-bordeaux-dark: #65002a;
            --vlife-anthracite: #333333;
            --vlife-gray: #666666;
            --vlife-light-gray: #f5f5f5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: var(--vlife-anthracite);
            background: white;
        }

        /* =========================
           HEADER
        ========================= */

        .navbar {
            height: 78px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 115px;
            height: auto;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--vlife-anthracite);
            font-size: 15px;
            font-weight: 600;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: var(--vlife-bordeaux);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--vlife-bordeaux), #666666);
            color: white !important;
            padding: 11px 22px;
            border-radius: 25px;
        }

        .btn-login:hover {
            opacity: 0.9;
            color: white !important;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            min-height: 570px;
            display: flex;
            align-items: center;
            padding: 70px 7%;
            background:
                linear-gradient(
                    110deg,
                    rgba(139, 0, 56, 0.96),
                    rgba(51, 51, 51, 0.93)
                );
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 450px;
            height: 450px;
            border: 70px solid rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            right: -120px;
            top: -100px;
        }

        .hero-content {
            max-width: 720px;
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            padding: 8px 17px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 25px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .hero h1 {
            font-size: 52px;
            line-height: 1.15;
            margin-bottom: 22px;
        }

        .hero h1 span {
            color: #ffffff;
        }

        .hero p {
            font-size: 19px;
            line-height: 1.7;
            max-width: 650px;
            margin-bottom: 32px;
            color: rgba(255, 255, 255, 0.92);
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-block;
            padding: 14px 28px;
            background: white;
            color: var(--vlife-bordeaux);
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-secondary {
            display: inline-block;
            padding: 14px 28px;
            border: 1px solid rgba(255, 255, 255, 0.7);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background: white;
            color: var(--vlife-bordeaux);
        }

        /* =========================
           SERVICES
        ========================= */

        .services-section {
            padding: 80px 7%;
            background: #fff;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title .small-title {
            color: var(--vlife-bordeaux);
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .section-title h2 {
            font-size: 36px;
            margin-bottom: 12px;
            color: var(--vlife-anthracite);
        }

        .section-title p {
            color: var(--vlife-gray);
            max-width: 650px;
            margin: auto;
            line-height: 1.6;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            max-width: 1200px;
            margin: auto;
        }

        .service-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #eeeeee;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.07);
            transition: 0.3s;
        }

        .service-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 35px rgba(139, 0, 56, 0.15);
        }

        .service-image {
            height: 210px;
            overflow: hidden;
            background: #eee;
        }

        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.4s;
        }

        .service-card:hover .service-image img {
            transform: scale(1.05);
        }

        .service-content {
            padding: 24px;
        }

        .service-content h3 {
            color: var(--vlife-bordeaux);
            font-size: 21px;
            margin-bottom: 10px;
        }

        .service-content p {
            color: var(--vlife-gray);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .service-link {
            text-decoration: none;
            color: var(--vlife-bordeaux);
            font-weight: bold;
            font-size: 14px;
        }

        .service-link:hover {
            text-decoration: underline;
        }

        /* =========================
           COMMENT ÇA MARCHE
        ========================= */

        .how-section {
            padding: 80px 7%;
            background: var(--vlife-light-gray);
        }

        .steps {
            max-width: 1050px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .step {
            text-align: center;
            background: white;
            padding: 35px 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .step-number {
            width: 55px;
            height: 55px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--vlife-bordeaux);
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        .step h3 {
            margin-bottom: 10px;
            color: var(--vlife-anthracite);
        }

        .step p {
            color: var(--vlife-gray);
            line-height: 1.6;
            font-size: 14px;
        }

        /* =========================
           CTA
        ========================= */

        .cta-section {
            padding: 80px 7%;
        }

        .cta-box {
            max-width: 1100px;
            margin: auto;
            padding: 55px;
            border-radius: 20px;
            text-align: center;
            background: linear-gradient(
                135deg,
                var(--vlife-bordeaux),
                var(--vlife-anthracite)
            );
            color: white;
        }

        .cta-box h2 {
            font-size: 35px;
            margin-bottom: 15px;
        }

        .cta-box p {
            max-width: 650px;
            margin: 0 auto 25px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #252525;
            color: white;
            padding: 45px 7% 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 50px;
            max-width: 1200px;
            margin: auto;
        }

        .footer-logo img {
            width: 105px;
            background: white;
            border-radius: 8px;
            padding: 5px;
            margin-bottom: 15px;
        }

        .footer-column h3 {
            margin-bottom: 15px;
            font-size: 17px;
        }

        .footer-column p,
        .footer-column a {
            color: #cccccc;
            font-size: 14px;
            line-height: 1.8;
            text-decoration: none;
        }

        .footer-column a:hover {
            color: white;
        }

        .copyright {
            text-align: center;
            border-top: 1px solid #444;
            margin-top: 35px;
            padding-top: 20px;
            color: #aaa;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 950px) {

            .nav-links {
                gap: 15px;
            }

            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .steps {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 700px) {

            .navbar {
                height: auto;
                min-height: 75px;
                padding: 15px 5%;
                flex-wrap: wrap;
                gap: 15px;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .hero {
                padding: 60px 6%;
                min-height: 520px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .hero p {
                font-size: 16px;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .section-title h2 {
                font-size: 30px;
            }

            .cta-box {
                padding: 40px 25px;
            }

            .cta-box h2 {
                font-size: 28px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         NAVIGATION
    ========================== -->

    <header class="navbar">

        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/vlife.png') }}" alt="Logo VLIFE">
        </a>

        <nav>
            <ul class="nav-links">
                <li>
                    <a href="{{ url('/') }}">Accueil</a>
                </li>

                <li>
                    <a href="#services">Services</a>
                </li>

                <li>
                    <a href="#fonctionnement">Comment ça marche</a>
                </li>

                <li>
                    <a href="#contact">Contact</a>
                </li>

                <li>
                    <a href="{{ route('login') }}" class="btn-login">
                        Se connecter
                    </a>
                </li>
            </ul>
        </nav>

    </header>


    <!-- =========================
         HERO
    ========================== -->

    <section class="hero">

        <div class="hero-content">

            <span class="hero-badge">
                Portail unifié de réservation VLIFE
            </span>

            <h1>
                Réservez simplement,
                <span>profitez pleinement.</span>
            </h1>

            <p>
                Découvrez les services VLIFE et réservez facilement
                l'activité ou la prestation qui correspond à vos besoins,
                depuis une seule plateforme.
            </p>

            <div class="hero-buttons">

                <a href="#services" class="btn-primary">
                    Découvrir nos services
                </a>

                <a href="{{ route('reservation.public') }}" class="btn-secondary">
                      Réserver maintenant
                </a>

            </div>

        </div>

    </section>


    <!-- =========================
         SERVICES
    ========================== -->

    <section class="services-section" id="services">

        <div class="section-title">

            <div class="small-title">
                Nos activités
            </div>

            <h2>
                Découvrez les services VLIFE
            </h2>

            <p>
                Une seule plateforme pour accéder aux différents
                services proposés par VLIFE.
            </p>

        </div>


        <div class="services-grid">

            <!-- VCUTS -->

            <article class="service-card">

                <div class="service-image">
                    <img
                        src="{{ asset('images/Vcuts.png') }}"
                        alt="VCUTS Barbers Shop">
                </div>

                <div class="service-content">

                    <h3>
                        VCUTS Barbers Shop
                    </h3>

                    <p>
                        Profitez de prestations de coiffure et de soins
                        adaptées à vos besoins.
                    </p>

                    <a href="#reservation" class="service-link">
                        Réserver →
                    </a>

                </div>

            </article>


            <!-- VITECH -->

            <article class="service-card">

                <div class="service-image">
                    <img
                        src="{{ asset('images/VitechImg.png') }}"
                        alt="VITECH">
                </div>

                <div class="service-content">

                    <h3>
                        VITECH
                    </h3>

                    <p>
                        Services professionnels liés au contrôle et à
                        l'inspection des véhicules.
                    </p>

                    <a href="#reservation" class="service-link">
                        Réserver →
                    </a>

                </div>

            </article>


            <!-- VITECH TRAINING -->

            <article class="service-card">

                <div class="service-image">
                    <img
                        src="{{ asset('images/VTCImg.png') }}"
                        alt="VITECH Training Center">
                </div>

                <div class="service-content">

                    <h3>
                        VITECH Training Center
                    </h3>

                    <p>
                        Découvrez les formations proposées par
                        notre centre de formation.
                    </p>

                    <a href="#reservation" class="service-link">
                        Réserver →
                    </a>

                </div>

            </article>


            <!-- VLOUNGE -->

            <article class="service-card">

                <div class="service-image">
                    <img
                        src="{{ asset('images/VloundeImg.png') }}"
                        alt="VLOUNGE Sport Bar">
                </div>

                <div class="service-content">

                    <h3>
                        VLOUNGE Sport Bar
                    </h3>

                    <p>
                        Un espace convivial pour vos moments de détente,
                        de sport et de divertissement.
                    </p>

                    <a href="#reservation" class="service-link">
                        Réserver →
                    </a>

                </div>

            </article>


            <!-- COWORKING -->

            <article class="service-card">

                <div class="service-image">
                    <img
                        src="{{ asset('images/Bureau2Coworking.jpeg') }}"
                        alt="Coworking VLIFE">
                </div>

                <div class="service-content">

                    <h3>
                        Coworking
                    </h3>

                    <p>
                        Des espaces de travail adaptés aux professionnels,
                        étudiants et entrepreneurs.
                    </p>

                    <a href="#reservation" class="service-link">
                        Réserver →
                    </a>

                </div>

            </article>


            <!-- SALLE DE RÉUNION -->

            <article class="service-card">

                <div class="service-image">
                    <img
                        src="{{ asset('images/salle de conferenceCoworking3.jpeg') }}"
                        alt="Salle de conférence VLIFE">
                </div>

                <div class="service-content">

                    <h3>
                        Salles & espaces
                    </h3>

                    <p>
                        Réservez des espaces adaptés aux réunions,
                        conférences et activités professionnelles.
                    </p>

                    <a href="#reservation" class="service-link">
                        Réserver →
                    </a>

                </div>

            </article>

        </div>

    </section>


    <!-- =========================
         COMMENT ÇA MARCHE
    ========================== -->

    <section class="how-section" id="fonctionnement">

        <div class="section-title">

            <div class="small-title">
                Simple et rapide
            </div>

            <h2>
                Comment effectuer une réservation ?
            </h2>

            <p>
                Notre portail vous accompagne en quelques étapes.
            </p>

        </div>


        <div class="steps">

            <div class="step">

                <div class="step-number">
                    1
                </div>

                <h3>
                    Choisissez un service
                </h3>

                <p>
                    Sélectionnez l'activité VLIFE qui correspond
                    à votre besoin.
                </p>

            </div>


            <div class="step">

                <div class="step-number">
                    2
                </div>

                <h3>
                    Choisissez une prestation
                </h3>

                <p>
                    Consultez les prestations disponibles et
                    choisissez celle que vous souhaitez réserver.
                </p>

            </div>


            <div class="step">

                <div class="step-number">
                    3
                </div>

                <h3>
                    Confirmez votre réservation
                </h3>

                <p>
                    Renseignez vos informations puis confirmez
                    votre demande de réservation.
                </p>

            </div>

        </div>

    </section>


    <!-- =========================
         CTA RÉSERVATION
    ========================== -->

    <section class="cta-section" id="reservation">

        <div class="cta-box">

            <h2>
                Prêt à effectuer votre réservation ?
            </h2>

            <p>
                Choisissez votre service et commencez votre réservation
                en quelques clics.
            </p>

            <a href="{{ route('reservation.public') }}" class="btn-primary">
               Commencer ma réservation
            </a>

        </div>

    </section>


    <!-- =========================
         FOOTER
    ========================== -->

    <footer id="contact">

        <div class="footer-content">

            <div class="footer-column footer-logo">

                <img
                    src="{{ asset('images/vlife.png') }}"
                    alt="VLIFE">

                <p>
                    VLIFE — votre portail unifié pour accéder
                    simplement à nos différents services.
                </p>

            </div>


            <div class="footer-column">

                <h3>
                    Navigation
                </h3>

                <p>
                    <a href="{{ url('/') }}">Accueil</a>
                </p>

                <p>
                    <a href="#services">Services</a>
                </p>

                <p>
                    <a href="#fonctionnement">
                        Comment ça marche
                    </a>
                </p>

            </div>


            <div class="footer-column">

                <h3>
                    Contact
                </h3>

                <p>
                    VLIFE
                </p>

                <p>
                    Contactez-nous pour toute information.
                </p>

            </div>

        </div>


        <div class="copyright">

            © {{ date('Y') }} VLIFE — Tous droits réservés.

        </div>

    </footer>

</body>

</html>