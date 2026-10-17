<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VLIFE - Portail de réservation</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background:#f7f7f7; min-height:100vh;">

    <!-- HEADER PUBLIC -->
    <header style="
        background:#ffffff;
        padding:18px 40px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    ">
        <div style="
            max-width:1100px;
            margin:auto;
            display:flex;
            align-items:center;
            justify-content:space-between;
        ">

            <a href="{{ url('/') }}" style="text-decoration:none;">
                <img
                    src="{{ asset('images/vlife.png') }}"
                    alt="VLIFE"
                    style="height:55px;"
                >
            </a>

            <div>
                <a
                    href="{{ url('/') }}"
                    style="
                        text-decoration:none;
                        color:#8B0038;
                        font-weight:600;
                    "
                >
                    Accueil
                </a>
            </div>

        </div>
    </header>


    <!-- CONTENU -->
    <main>
        @yield('content')
    </main>


    <!-- FOOTER -->
    <footer style="
        text-align:center;
        padding:25px;
        color:#666666;
        font-size:14px;
    ">
        © {{ date('Y') }} VLIFE —
        Portail unifié de réservation omnicanal
    </footer>

</body>

</html>