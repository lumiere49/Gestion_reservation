<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VLIFE - Connexion</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="login-page">

        {{-- PANNEAU GAUCHE --}}
        <div class="login-brand">

            <div class="brand-content">

                <div class="vlife-logo">
                    <span>V</span>
                    <strong>LIFE</strong>
                </div>

                <h1>
                    Portail de réservation
                </h1>

                <p>
                    Gérez facilement les réservations,
                    les prestations, les clients et les paiements
                    de l'ensemble des services VLIFE.
                </p>

                <div class="brand-line"></div>

                <small>
                    Gestion multiservice • Réservation • Paiement
                </small>

            </div>

        </div>


        {{-- PANNEAU DROIT --}}
        <div class="login-container">

            <div class="login-card">

                <div class="mobile-logo">
                    <div class="vlife-logo">
                        <span>V</span>
                        <strong>LIFE</strong>
                    </div>
                </div>


                <div class="login-header">

                    <h2>
                        Bienvenue
                    </h2>

                    <p>
                        Connectez-vous à votre espace de gestion
                    </p>

                </div>


                {{-- MESSAGES D'ERREUR --}}
                @if ($errors->any())

                    <div class="alert-error">

                        <div class="alert-icon">
                            !
                        </div>

                        <div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>

                    </div>

                @endif


                {{-- FORMULAIRE --}}
                <form
                    action="{{ route('login.submit') }}"
                    method="POST"
                >

                    @csrf


                    {{-- EMAIL --}}
                    <div class="form-group">

                        <label for="email">
                            Adresse email
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ✉
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="exemple@vlife.cm"
                                autocomplete="email"
                                required
                                autofocus
                            >

                        </div>

                    </div>


                    {{-- MOT DE PASSE --}}
                    <div class="form-group">

                        <label for="mot_de_passe">
                            Mot de passe
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ●
                            </span>

                            <input
                                type="password"
                                id="mot_de_passe"
                                name="mot_de_passe"
                                placeholder="Votre mot de passe"
                                autocomplete="current-password"
                                required
                            >

                        </div>

                    </div>


                    {{-- BOUTON --}}
                    <button
                        type="submit"
                        class="btn-login"
                    >
                        <span>
                            Se connecter
                        </span>

                        <span class="arrow">
                            →
                        </span>
                    </button>

                </form>


                <div class="login-footer">

                    <span>
                        © {{ date('Y') }} VLIFE
                    </span>

                    <span>
                        Portail de gestion
                    </span>

                </div>

            </div>

        </div>

    </div>


    <style>

        :root {
            --vlife-bordeaux: #8b0038;
            --vlife-bordeaux-dark: #65002a;
            --vlife-anthracite: #2f3033;
            --vlife-gray: #74767b;
            --vlife-light: #f6f6f8;
            --vlife-border: #dedfe3;
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            min-height: 100vh;
            font-family:
                Arial,
                Helvetica,
                sans-serif;
            background: var(--vlife-light);
            color: var(--vlife-anthracite);
        }


        .login-page {
            min-height: 100vh;
            display: flex;
        }


        /* =========================
           PANNEAU VLIFE
        ========================= */

        .login-brand {
            width: 46%;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 60px;

            background:
                linear-gradient(
                    135deg,
                    #65002a 0%,
                    #8b0038 48%,
                    #414246 100%
                );

            position: relative;
            overflow: hidden;
        }


        .login-brand::before {
            content: "";
            position: absolute;

            width: 420px;
            height: 420px;

            border: 70px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;

            top: -180px;
            right: -160px;
        }


        .login-brand::after {
            content: "";
            position: absolute;

            width: 300px;
            height: 300px;

            border: 50px solid rgba(255, 255, 255, 0.05);
            border-radius: 50%;

            bottom: -160px;
            left: -120px;
        }


        .brand-content {
            position: relative;
            z-index: 2;

            max-width: 520px;

            color: white;
        }


        .vlife-logo {
            display: inline-flex;
            align-items: center;

            margin-bottom: 45px;

            font-size: 34px;
            letter-spacing: 1px;
        }


        .vlife-logo span {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 54px;
            height: 54px;

            margin-right: 5px;

            border: 3px solid white;
            border-radius: 50%;

            font-size: 26px;
            font-weight: 800;
        }


        .vlife-logo strong {
            font-size: 34px;
            font-weight: 800;
        }


        .brand-content h1 {
            margin: 0 0 18px;

            font-size: 40px;
            line-height: 1.15;
            font-weight: 700;
        }


        .brand-content p {
            margin: 0;

            max-width: 470px;

            font-size: 16px;
            line-height: 1.7;

            color: rgba(255, 255, 255, 0.88);
        }


        .brand-line {
            width: 70px;
            height: 3px;

            margin: 28px 0 18px;

            background: white;
            border-radius: 5px;
        }


        .brand-content small {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.75);
        }


        /* =========================
           ZONE CONNEXION
        ========================= */

        .login-container {
            width: 54%;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px;
        }


        .login-card {
            width: 100%;
            max-width: 470px;
        }


        .mobile-logo {
            display: none;
        }


        .login-header {
            margin-bottom: 30px;
        }


        .login-header h2 {
            margin: 0 0 8px;

            font-size: 30px;
            font-weight: 700;

            color: var(--vlife-anthracite);
        }


        .login-header p {
            margin: 0;

            color: var(--vlife-gray);
            font-size: 14px;
        }


        /* =========================
           ERREUR
        ========================= */

        .alert-error {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            margin-bottom: 22px;
            padding: 13px 15px;

            background: #fff1f4;
            border: 1px solid #f0c5d1;
            border-radius: 8px;

            color: #9b003b;

            font-size: 13px;
        }


        .alert-error p {
            margin: 0;
        }


        .alert-error p + p {
            margin-top: 4px;
        }


        .alert-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            min-width: 22px;
            height: 22px;

            border-radius: 50%;

            background: #9b003b;
            color: white;

            font-weight: 700;
            font-size: 12px;
        }


        /* =========================
           FORMULAIRE
        ========================= */

        .form-group {
            margin-bottom: 21px;
        }


        .form-group label {
            display: block;

            margin-bottom: 8px;

            color: var(--vlife-anthracite);

            font-size: 14px;
            font-weight: 600;
        }


        .input-wrapper {
            position: relative;
        }


        .input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--vlife-gray);

            font-size: 13px;

            pointer-events: none;
        }


        .input-wrapper input {
            width: 100%;

            padding: 13px 14px 13px 43px;

            border: 1px solid var(--vlife-border);
            border-radius: 8px;

            background: white;

            color: var(--vlife-anthracite);

            font-size: 14px;

            outline: none;

            transition: all 0.2s ease;
        }


        .input-wrapper input::placeholder {
            color: #a3a5aa;
        }


        .input-wrapper input:focus {
            border-color: var(--vlife-bordeaux);

            box-shadow:
                0 0 0 3px rgba(139, 0, 56, 0.08);
        }


        /* =========================
           BOUTON
        ========================= */

        .btn-login {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;

            margin-top: 8px;
            padding: 13px 18px;

            border: none;
            border-radius: 8px;

            background:
                linear-gradient(
                    135deg,
                    var(--vlife-bordeaux),
                    #55565a
                );

            color: white;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            transition: all 0.2s ease;
        }


        .btn-login:hover {
            transform: translateY(-1px);

            box-shadow:
                0 7px 18px rgba(139, 0, 56, 0.22);
        }


        .btn-login:active {
            transform: translateY(0);
        }


        .arrow {
            font-size: 18px;
            line-height: 1;
        }


        /* =========================
           FOOTER
        ========================= */

        .login-footer {
            display: flex;
            justify-content: space-between;

            margin-top: 35px;
            padding-top: 18px;

            border-top: 1px solid var(--vlife-border);

            color: #96989d;

            font-size: 11px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .login-brand {
                width: 40%;
                padding: 35px;
            }

            .login-container {
                width: 60%;
                padding: 30px;
            }

            .brand-content h1 {
                font-size: 32px;
            }

        }


        @media (max-width: 700px) {

            .login-page {
                display: block;
                min-height: 100vh;
            }


            .login-brand {
                display: none;
            }


            .login-container {
                width: 100%;
                min-height: 100vh;

                padding: 25px 20px;

                align-items: center;
            }


            .login-card {
                max-width: 440px;
            }


            .mobile-logo {
                display: block;
                text-align: center;
                margin-bottom: 35px;
            }


            .mobile-logo .vlife-logo {
                margin-bottom: 0;
            }


            .mobile-logo .vlife-logo span {
                width: 45px;
                height: 45px;

                font-size: 21px;
            }


            .mobile-logo .vlife-logo strong {
                font-size: 29px;
            }


            .login-header h2 {
                font-size: 27px;
            }


            .login-footer {
                flex-direction: column;
                align-items: center;
                gap: 6px;
            }

        }


        @media (max-width: 400px) {

            .login-container {
                padding: 20px 15px;
            }


            .login-header h2 {
                font-size: 24px;
            }


            .input-wrapper input {
                padding-top: 12px;
                padding-bottom: 12px;
            }

        }

    </style>

</body>

</html>