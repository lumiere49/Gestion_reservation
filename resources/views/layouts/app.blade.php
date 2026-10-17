<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VLIFE - Gestion des réservations</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="vlife-layout">

        <!-- ============================= -->
        <!-- BARRE LATÉRALE -->
        <!-- ============================= -->

        <aside class="vlife-sidebar">

            <!-- LOGO -->
            <div class="vlife-logo-container">

                <img
                    src="{{ asset('images/vlife.png') }}"
                    alt="VLIFE"
                    class="vlife-logo"
                >

                <div class="vlife-logo-title">
                    PORTAIL VLIFE
                </div>

            </div>


            <!-- MENU -->
            <nav class="vlife-navigation">

                <div class="vlife-menu-title">
                    MENU PRINCIPAL
                </div>

                @if(auth()->user()->role === 'Administrateur')

    <a href="/"
       class="vlife-menu-link {{ request()->is('/') ? 'active' : '' }}">

        <span class="vlife-icon">⌂</span>
        <span>Tableau de bord</span>

    </a>

@endif


                <a href="/clients"
                   class="vlife-menu-link {{ request()->is('clients*') ? 'active' : '' }}">

                    <span class="vlife-icon">♙</span>
                    <span>Clients</span>

                </a>


                <a href="/services"
                   class="vlife-menu-link {{ request()->is('services*') ? 'active' : '' }}">

                    <span class="vlife-icon">▣</span>
                    <span>Services</span>

                </a>


                <a href="/prestations"
                   class="vlife-menu-link {{ request()->is('prestations*') ? 'active' : '' }}">

                    <span class="vlife-icon">✦</span>
                    <span>Prestations</span>

                </a>


                <a href="/ressources"
                   class="vlife-menu-link {{ request()->is('ressources*') ? 'active' : '' }}">

                    <span class="vlife-icon">◉</span>
                    <span>Ressources</span>

                </a>


                <a href="/reservations"
                   class="vlife-menu-link {{ request()->is('reservations*') ? 'active' : '' }}">

                    <span class="vlife-icon">▣</span>
                    <span>Réservations</span>

                </a>


                <a href="{{ route('detail-reservations.index') }}"
   class="vlife-menu-link {{ request()->is('detail-reservations*') ? 'active' : '' }}">

    <span class="vlife-icon">☷</span>
    <span>Détails réservations</span>

</a>


                @if(auth()->user()->role !== 'Employe')

    <a href="/paiements"
       class="vlife-menu-link {{ request()->is('paiements*') ? 'active' : '' }}">

        <span class="vlife-icon">₣</span>
        <span>Paiements</span>

    </a>

@endif

            </nav>


            <!-- BAS DE LA SIDEBAR -->
            <div class="vlife-sidebar-bottom">

                <div class="vlife-system-status">

                    <span class="status-dot"></span>

                    Système opérationnel

                </div>

                <div class="vlife-version">

                    VLIFE • Portail de réservation

                </div>

            </div>

        </aside>


        <!-- ============================= -->
        <!-- PARTIE PRINCIPALE -->
        <!-- ============================= -->

        <div class="vlife-main">


            <!-- ============================= -->
            <!-- EN-TÊTE -->
            <!-- ============================= -->

            <header class="vlife-header">

                <div class="vlife-header-left">

                    <div class="vlife-page-title">

                        <h1>
                            Gestion des réservations
                        </h1>

                        <p>
                            Portail unifié de réservation omnicanal
                        </p>

                    </div>

                </div>


                <div class="vlife-header-right">

                    <div class="vlife-date">

                        {{ now()->format('d/m/Y') }}

                    </div>


                    <div class="vlife-user">

                        <div class="vlife-user-avatar">
                            A
                        </div>

                        <div class="vlife-user-info">

                            <strong>
                                Administrateur
                            </strong>

                            <small>
                                Gestionnaire
                            </small>

                        </div>

                    </div>

                </div>

            </header>


            <!-- ============================= -->
            <!-- CONTENU -->
            <!-- ============================= -->

            <main class="vlife-content">

                @yield('content')

            </main>


            <!-- ============================= -->
            <!-- FOOTER -->
            <!-- ============================= -->

            <footer class="vlife-footer">

                <span>
                    © {{ date('Y') }} VLIFE
                </span>

                <span>
                    Portail unifié de réservation omnicanal
                </span>

            </footer>

        </div>

    </div>

</body>

</html>