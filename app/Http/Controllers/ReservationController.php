<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\Prestation;
use App\Models\Ressource;
use Illuminate\Http\Request;
use App\Models\DetailReservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
   public function index(Request $request)
{
    $utilisateur = auth()->user();

    $query = Reservation::with([
        'client',
        'service',
        'detailReservations.prestation',
        'ressources'
    ]);

    // Le Responsable ne voit que les réservations de son service
    if ($utilisateur->role === 'Responsable') {
        $query->where('idService', $utilisateur->idService);
    }

    // Filtre manuel pour l'Administrateur
    if (
        $utilisateur->role === 'Administrateur'
        && $request->filled('idService')
    ) {
        $query->where('idService', $request->idService);
    }

    $reservations = $query->get();

    return view('reservations.index', compact('reservations'));
}
public function byService($idService)
{
    $prestations = Prestation::where('idService', $idService)->get();

    return response()->json($prestations);
}

public function ressourcesParService($idService)
{
    $ressources = Ressource::where('idService', $idService)
        ->where('etat', 'Disponible')
        ->get();

    return response()->json($ressources);
}
   public function create()
{
    $utilisateur = auth()->user();

    $clients = Client::all();
    $prestations = Prestation::all();

    if ($utilisateur->role === 'Responsable') {
        $services = Service::where(
            'idService',
            $utilisateur->idService
        )->get();
    } else {
        $services = Service::all();
    }

    return view(
        'reservations.create',
        compact('clients', 'services', 'prestations')
    );
}

public function publicCreate()
{
    $services = Service::all();

    $prestations = Prestation::all();

    return view(
        'reservations.public.create',
        compact('services', 'prestations')
    );
}

public function publicConfirmation($idReservation)
{
    $reservation = Reservation::with([
        'client',
        'service',
        'detailReservations.prestation',
        'ressources'
    ])->findOrFail($idReservation);

    return view(
        'reservations.public.confirmation',
        compact('reservation')
    );
}

public function publicStore(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | VALIDATION DES INFORMATIONS CLIENT
    |--------------------------------------------------------------------------
    */

    $request->validate([
        'nom' => 'required|string|max:100',
        'prenom' => 'required|string|max:100',
        'telephone' => 'required|string|max:30',
        'email' => 'required|email|max:150',

        'idService' => 'required|exists:services,idService',
        'idPrestation' => 'required|exists:prestations,idPrestation',

        'date_reservation' => 'required|date|after_or_equal:today',
        'heure_debut' => 'required',
        'heure_fin' => 'required|after:heure_debut',
    ]);


    /*
    |--------------------------------------------------------------------------
    | VÉRIFICATION DE LA PRESTATION
    |--------------------------------------------------------------------------
    */

    $prestation = Prestation::findOrFail(
        $request->idPrestation
    );

    if ($prestation->idService != $request->idService) {

        return back()
            ->withErrors([
                'idPrestation' =>
                    'La prestation sélectionnée ne correspond pas au service choisi.'
            ])
            ->withInput();
    }


    /*
    |--------------------------------------------------------------------------
    | RECHERCHE OU CRÉATION DU CLIENT
    |--------------------------------------------------------------------------
    */

    $client = Client::where('email', $request->email)->first();

if (!$client) {

    // Vérifier également que le téléphone n'est pas déjà utilisé
    $telephoneExiste = Client::where(
        'telephone',
        $request->telephone
    )->exists();

    if ($telephoneExiste) {
        return back()
            ->withErrors([
                'telephone' =>
                    'Ce numéro de téléphone est déjà utilisé par un autre client.'
            ])
            ->withInput();
    }

    // Création du nouveau client
    $client = Client::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'telephone' => $request->telephone,
        'email' => $request->email,
    ]);

} else {

    /*
    |--------------------------------------------------------------------------
    | Client existant
    |--------------------------------------------------------------------------
    |
    | On conserve son téléphone pour éviter une violation
    | de la contrainte UNIQUE.
    |
    */

    $client->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
    ]);
}


    /*
    |--------------------------------------------------------------------------
    | DÉTERMINATION DU TYPE DE RESSOURCE
    |--------------------------------------------------------------------------
    */

    $nomPrestation = strtolower($prestation->nom);

    $typesRessources = [];


    /*
    |--------------------------------------------------------------------------
    | VCUTS BARBERS SHOP
    |--------------------------------------------------------------------------
    */

    if ($request->idService == 2) {

        if (
            str_contains($nomPrestation, 'coiffure') ||
            str_contains($nomPrestation, 'coupe') ||
            str_contains($nomPrestation, 'barbe') ||
            str_contains($nomPrestation, 'fresh up')
        ) {

            $typesRessources = [
                'Poste de coiffure'
            ];

        } elseif (
            str_contains($nomPrestation, 'pédicure') ||
            str_contains($nomPrestation, 'pedicure') ||
            str_contains($nomPrestation, 'manicure') ||
            str_contains($nomPrestation, 'manucure')
        ) {

            $typesRessources = [
                'Poste de pédicure'
            ];

        } elseif (str_contains($nomPrestation, 'massage')) {

            $typesRessources = [
                'Cabine de soins'
            ];

        } elseif (
            str_contains($nomPrestation, 'visage') ||
            str_contains($nomPrestation, 'gommage') ||
            str_contains($nomPrestation, "coup d'éclat")
        ) {

            $typesRessources = [
                'Cabine de soins'
            ];

        } else {

            return back()
                ->withErrors([
                    'ressource' =>
                        'Aucune ressource compatible avec cette prestation.'
                ])
                ->withInput();
        }


    /*
    |--------------------------------------------------------------------------
    | VITECH
    |--------------------------------------------------------------------------
    */

    } elseif ($request->idService == 3) {

        $typesRessources = [
            'Poste de contrôles',
            'Ligne de contrôle'
        ];


    /*
    |--------------------------------------------------------------------------
    | VITECH TRAINING CENTER
    |--------------------------------------------------------------------------
    */

    } elseif ($request->idService == 4) {

        if (str_contains($nomPrestation, 'simulateur')) {

            $typesRessources = [
                'Simulateur'
            ];

        } elseif (
            str_contains($nomPrestation, 'conduite') ||
            str_contains($nomPrestation, 'pratique')
        ) {

            $typesRessources = [
                'Véhicule'
            ];

        } else {

            $typesRessources = [
                'Salle'
            ];
        }


    /*
    |--------------------------------------------------------------------------
    | VLOUNGE SPORT BAR
    |--------------------------------------------------------------------------
    */

    } elseif ($request->idService == 5) {

        if (
            str_contains($nomPrestation, 'écran') ||
            str_contains($nomPrestation, 'ecran') ||
            str_contains($nomPrestation, 'projecteur')
        ) {

            $typesRessources = [
                'Équipement audiovisuel'
            ];

        } elseif (str_contains($nomPrestation, 'dj')) {

            $typesRessources = [
                'Personnel / animation'
            ];

        } else {

            $typesRessources = [
                'Espace événementiel',
                'Espace privé'
            ];
        }


    /*
    |--------------------------------------------------------------------------
    | COWORKING
    |--------------------------------------------------------------------------
    */

    } elseif ($request->idService == 6) {

        if (
            str_contains($nomPrestation, 'conférence') ||
            str_contains($nomPrestation, 'conference')
        ) {

            $typesRessources = [
                'Salle'
            ];

        } elseif (str_contains($nomPrestation, 'bureau')) {

            $typesRessources = [
                'Bureau partagé',
                'Bureau individuel'
            ];

        } else {

            $typesRessources = [
                'Salle',
                'Bureau partagé',
                'Bureau individuel'
            ];
        }
    }


    /*
    |--------------------------------------------------------------------------
    | RECHERCHE D'UNE RESSOURCE DISPONIBLE
    |--------------------------------------------------------------------------
    */

    $ressources = Ressource::where(
        'idService',
        $request->idService
    )
        ->where('etat', 'Disponible')
        ->whereIn('type', $typesRessources)
        ->get();

    $ressourceDisponible = null;

    foreach ($ressources as $ressource) {

        $conflit = $ressource->reservations()
            ->where(
                'date_reservation',
                $request->date_reservation
            )
            ->whereIn('statut', [
                'En_attente',
                'Confirmee'
            ])
            ->where(function ($query) use ($request) {

                $query->where(
                    'heure_debut',
                    '<',
                    $request->heure_fin
                )
                ->where(
                    'heure_fin',
                    '>',
                    $request->heure_debut
                );

            })
            ->exists();


        if (!$conflit) {

            $ressourceDisponible = $ressource;

            break;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | AUCUNE RESSOURCE DISPONIBLE
    |--------------------------------------------------------------------------
    */

    if (!$ressourceDisponible) {

        return back()
            ->withErrors([
                'ressource' =>
                    'Aucune ressource compatible n’est disponible pour ce créneau.'
            ])
            ->withInput();
    }


    /*
    |--------------------------------------------------------------------------
    | CRÉATION DE LA RÉSERVATION
    |--------------------------------------------------------------------------
    */

    $reservation = Reservation::create([

        'date_reservation' => $request->date_reservation,

        'heure_debut' => $request->heure_debut,

        'heure_fin' => $request->heure_fin,

        'statut' => 'En_attente',

        'canal_reservation' => 'Site_web',

        'idClient' => $client->idClient,

        'idService' => $request->idService,

        'idUtilisateur' => null,
    ]);


    /*
    |--------------------------------------------------------------------------
    | CRÉATION DU DÉTAIL DE RÉSERVATION
    |--------------------------------------------------------------------------
    */

    DetailReservation::create([

        'quantite' => 1,

        'prix' => $prestation->prix,

        'idReservation' =>
            $reservation->idReservation,

        'idPrestation' =>
            $prestation->idPrestation,
    ]);


    /*
    |--------------------------------------------------------------------------
    | AFFECTATION AUTOMATIQUE DE LA RESSOURCE
    |--------------------------------------------------------------------------
    */

    $reservation->ressources()->attach(
        $ressourceDisponible->idRessource
    );


    /*
    |--------------------------------------------------------------------------
    | REDIRECTION VERS LA CONFIRMATION
    |--------------------------------------------------------------------------
    */

    return redirect()->route(
        'reservation.confirmation',
        $reservation->idReservation
    );
}

    public function store(Request $request)
{
    $request->validate([
        'idClient' => 'required|exists:clients,idClient',
        'idService' => 'required|exists:services,idService',
        'idPrestation' => 'required|exists:prestations,idPrestation',
        'date_reservation' => 'required|date',
        'heure_debut' => 'required',
        'heure_fin' => 'required|after:heure_debut',
        'statut' => 'required|in:En_attente,Confirmee,Annulee,Terminee',
        'canal_reservation' => 'required|in:Telephone,Physique,Email,Site_web,Application_mobile',
        'nombre_personnes' => 'required|integer|min:1',
        ]);

        $utilisateur = auth()->user();

if (
    $utilisateur->role === 'Responsable'
    && $request->idService != $utilisateur->idService
) {
    abort(
        403,
        'Accès refusé. Vous ne pouvez créer une réservation que pour votre service.'
    );
}


    $prestation = Prestation::findOrFail($request->idPrestation);

    /*
    |--------------------------------------------------------------------------
    | Vérification prestation / service
    |--------------------------------------------------------------------------
    */

    if ($prestation->idService != $request->idService) {
        return back()
            ->withErrors([
                'idPrestation' =>
                    'Cette prestation ne correspond pas au service sélectionné.'
            ])
            ->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Détermination automatique du type de ressource
    |--------------------------------------------------------------------------
    */

    $nomPrestation = strtolower($prestation->nom);

    $typesRessources = [];

    /*
    |--------------------------------------------------------------------------
    | VCUTS BARBERS SHOP
    |--------------------------------------------------------------------------
    */

    if ($request->idService == 2) {

        // Coiffure, coupe, barbe et Fresh Up
        if (
            str_contains($nomPrestation, 'coiffure') ||
            str_contains($nomPrestation, 'coupe') ||
            str_contains($nomPrestation, 'barbe') ||
            str_contains($nomPrestation, 'fresh up')
        ) {
            $typesRessources = [
                'Poste de coiffure'
            ];
        }

        // Pédicure et manucure
        elseif (
            str_contains($nomPrestation, 'pédicure') ||
            str_contains($nomPrestation, 'pedicure') ||
            str_contains($nomPrestation, 'manicure') ||
            str_contains($nomPrestation, 'manucure')
        ) {
            /*
             * Dans notre base actuelle, le poste disponible
             * pour ces soins est le siège à pédicure.
             */
            $typesRessources = [
                'Poste de pédicure'
            ];
        }

        // Massages
        elseif (str_contains($nomPrestation, 'massage')) {
            $typesRessources = [
                'Cabine de soins'
            ];
        }

        // Soins du visage et gommages
        elseif (
            str_contains($nomPrestation, 'visage') ||
            str_contains($nomPrestation, 'gommage') ||
            str_contains($nomPrestation, "coup d'éclat")
        ) {
            $typesRessources = [
                'Cabine de soins'
            ];
        }

        else {
            return back()
                ->withErrors([
                    'ressource' =>
                        'Aucune ressource compatible n’est définie pour cette prestation.'
                ])
                ->withInput();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VITECH
    |--------------------------------------------------------------------------
    */

    elseif ($request->idService == 3) {

        $typesRessources = [
            'Poste de contrôles',
            'Ligne de contrôle'
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | VITECH TRAINING CENTER
    |--------------------------------------------------------------------------
    */

    elseif ($request->idService == 4) {

        if (str_contains($nomPrestation, 'simulateur')) {

            $typesRessources = [
                'Simulateur'
            ];
        }

        elseif (
            str_contains($nomPrestation, 'conduite') ||
            str_contains($nomPrestation, 'pratique')
        ) {

            $typesRessources = [
                'Véhicule'
            ];
        }

        else {

            $typesRessources = [
                'Salle'
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VLOUNGE SPORT BAR
    |--------------------------------------------------------------------------
    */

    elseif ($request->idService == 5) {

        if (
            str_contains($nomPrestation, 'écran') ||
            str_contains($nomPrestation, 'ecran') ||
            str_contains($nomPrestation, 'projecteur')
        ) {

            $typesRessources = [
                'Équipement audiovisuel'
            ];
        }

        elseif (str_contains($nomPrestation, 'dj')) {

            $typesRessources = [
                'Personnel / animation'
            ];
        }

        else {

            $typesRessources = [
                'Espace événementiel',
                'Espace privé'
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | COWORKING
    |--------------------------------------------------------------------------
    */

    elseif ($request->idService == 6) {

        if (
            str_contains($nomPrestation, 'conférence') ||
            str_contains($nomPrestation, 'conference')
        ) {

            $typesRessources = [
                'Salle'
            ];
        }

        elseif (str_contains($nomPrestation, 'bureau')) {

            $typesRessources = [
                'Bureau partagé',
                'Bureau individuel'
            ];
        }

        else {

            $typesRessources = [
                'Salle',
                'Bureau partagé',
                'Bureau individuel'
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Recherche d'une ressource disponible
    |--------------------------------------------------------------------------
    */

    $ressources = Ressource::where('idService', $request->idService)
        ->where('etat', 'Disponible')
        ->whereIn('type', $typesRessources)
        ->get();

    $ressourceDisponible = null;

    foreach ($ressources as $ressource) {

        $conflit = $ressource->reservations()
            ->where('date_reservation', $request->date_reservation)
            ->whereIn('statut', [
                'En_attente',
                'Confirmee'
            ])
            ->where(function ($query) use ($request) {

                $query->where(
                    'heure_debut',
                    '<',
                    $request->heure_fin
                )
                ->where(
                    'heure_fin',
                    '>',
                    $request->heure_debut
                );
            })
            ->exists();

        if (!$conflit) {
            $ressourceDisponible = $ressource;
            break;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Aucune ressource disponible
    |--------------------------------------------------------------------------
    */

    if (!$ressourceDisponible) {

        return back()
            ->withErrors([
                'ressource' =>
                    'Aucune ressource compatible n’est disponible pour ce créneau.'
            ])
            ->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Création de la réservation
    |--------------------------------------------------------------------------
    */

    $reservation = Reservation::create([
        'date_reservation' => $request->date_reservation,
        'heure_debut' => $request->heure_debut,
        'heure_fin' => $request->heure_fin,
        'statut' => $request->statut,
        'canal_reservation' => $request->canal_reservation,
        'idClient' => $request->idClient,
        'idService' => $request->idService,
        'idUtilisateur' => Auth::id(),
    ]);

    /*
    |--------------------------------------------------------------------------
    | Création du détail
    |--------------------------------------------------------------------------
    */


// ============================================================
// CALCUL DU PRIX SELON L'OPTION VLOUNGE
// ============================================================

$nomPrestation = strtolower($prestation->nom);

$quantite = 1;
$prix = $prestation->prix;

// ------------------------------------------------------------
// OPTION 1 : 3 000 FCFA par personne
// ------------------------------------------------------------
if (str_contains($nomPrestation, 'option 1')) {

    $quantite = (int) $request->nombre_personnes;
    $prix = 3000 * $quantite;
}

// ------------------------------------------------------------
// OPTION 2 : 50 000 FCFA — location fixe de l'espace
// ------------------------------------------------------------
elseif (str_contains($nomPrestation, 'option 2')) {

    $quantite = 1;
    $prix = 50000;
}

// ------------------------------------------------------------
// OPTION 3 : 5 000 FCFA par personne
// ------------------------------------------------------------
elseif (str_contains($nomPrestation, 'option 3')) {

    $quantite = (int) $request->nombre_personnes;
    $prix = 5000 * $quantite;
}

// ------------------------------------------------------------
// OPTION 4 : 400 000 FCFA — location fixe de la salle
// ------------------------------------------------------------
elseif (str_contains($nomPrestation, 'option 4')) {

    $quantite = 1;
    $prix = 400000;
}

// ============================================================
// ENREGISTREMENT DU DETAIL
// ============================================================

DetailReservation::create([
    'quantite' => $quantite,
    'prix' => $prix,
    'idReservation' => $reservation->idReservation,
    'idPrestation' => $prestation->idPrestation,
    
]);

    /*
    |--------------------------------------------------------------------------
    | Affectation automatique de la ressource
    |--------------------------------------------------------------------------
    */

    $reservation->ressources()->attach(
        $ressourceDisponible->idRessource
    );

    /*
    |--------------------------------------------------------------------------
    | Retour
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('reservations.index')
        ->with(
            'success',
            'Réservation enregistrée avec succès. Ressource affectée : '
            . $ressourceDisponible->nom
        );
}

public function show($id)
{
    $utilisateur = auth()->user();

    $reservation = Reservation::with([
        'client',
        'service',
        'detailReservations.prestation',
        'ressources'
    ])->findOrFail($id);

    if (
        $utilisateur->role === 'Responsable'
        && $reservation->idService != $utilisateur->idService
    ) {
        abort(403, 'Accès refusé. Vous ne pouvez consulter que les réservations de votre service.');
    }

    return view('reservations.show', compact('reservation'));
}

    public function edit($id)
{
    $utilisateur = auth()->user();

    // L'employé ne peut pas modifier une réservation
    if ($utilisateur->role === 'Employe') {
        abort(
            403,
            'Accès refusé. Les employés ne peuvent pas modifier les réservations.'
        );
    }

    $reservation = Reservation::findOrFail($id);

    // Le Responsable ne peut modifier que les réservations de son service
    if (
        $utilisateur->role === 'Responsable'
        && $reservation->idService != $utilisateur->idService
    ) {
        abort(
            403,
            'Accès refusé. Vous ne pouvez modifier que les réservations de votre service.'
        );
    }

    $clients = Client::all();

    if ($utilisateur->role === 'Responsable') {
        $services = Service::where(
            'idService',
            $utilisateur->idService
        )->get();
    } else {
        $services = Service::all();
    }

    return view(
        'reservations.edit',
        compact('reservation', 'clients', 'services')
    );
}

    public function update(Request $request, $id)
{
    $utilisateur = auth()->user();

if ($utilisateur->role === 'Employe') {
    abort(
        403,
        'Accès refusé. Les employés ne peuvent pas modifier les réservations.'
    );
}

$reservation = Reservation::findOrFail($id);

if (
    $utilisateur->role === 'Responsable'
    && $reservation->idService != $utilisateur->idService
) {
    abort(
        403,
        'Accès refusé. Vous ne pouvez modifier que les réservations de votre service.'
    );
}

    $request->validate([
        'idClient' => 'required|exists:clients,idClient',
        'idService' => 'required|exists:services,idService',
        'idPrestation' => 'required|exists:prestations,idPrestation',
        'date_reservation' => 'required|date',
        'heure_debut' => 'required',
        'heure_fin' => 'required|after:heure_debut',
        'statut' => 'required',
        'canal_reservation' => 'required',
    ]);

    $prestation = Prestation::findOrFail($request->idPrestation);

    /*
    |--------------------------------------------------------------------------
    | Vérifier que la prestation appartient au service
    |--------------------------------------------------------------------------
    */

    if ($prestation->idService != $request->idService) {

        return back()
            ->withErrors([
                'idPrestation' =>
                    'Cette prestation ne correspond pas au service sélectionné.'
            ])
            ->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Déterminer le type de ressource nécessaire
    |--------------------------------------------------------------------------
    */

    $nomPrestation = strtolower($prestation->nom);

    $typesRessources = [];

    /*
    |--------------------------------------------------------------------------
    | VCUTS
    |--------------------------------------------------------------------------
    */

    if ($request->idService == 2) {

        if (
            str_contains($nomPrestation, 'coiffure') ||
            str_contains($nomPrestation, 'coupe') ||
            str_contains($nomPrestation, 'barbe') ||
            str_contains($nomPrestation, 'fresh up')
        ) {

            $typesRessources = [
                'Poste de coiffure'
            ];
        }

        elseif (
            str_contains($nomPrestation, 'pédicure') ||
            str_contains($nomPrestation, 'pedicure') ||
            str_contains($nomPrestation, 'manicure') ||
            str_contains($nomPrestation, 'manucure')
        ) {

            $typesRessources = [
                'Poste de pédicure'
            ];
        }

        elseif (str_contains($nomPrestation, 'massage')) {

            $typesRessources = [
                'Cabine de soins'
            ];
        }

        elseif (
            str_contains($nomPrestation, 'visage') ||
            str_contains($nomPrestation, 'gommage') ||
            str_contains($nomPrestation, "coup d'éclat")
        ) {

            $typesRessources = [
                'Cabine de soins'
            ];
        }

        else {

            return back()
                ->withErrors([
                    'ressource' =>
                        'Aucune ressource compatible n’est définie pour cette prestation.'
                ])
                ->withInput();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VITECH
    |--------------------------------------------------------------------------
    */

    elseif ($request->idService == 3) {

        $typesRessources = [
            'Poste de contrôles',
            'Ligne de contrôle'
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | VITECH TRAINING CENTER
    |--------------------------------------------------------------------------
    */

    elseif ($request->idService == 4) {

        if (str_contains($nomPrestation, 'simulateur')) {

            $typesRessources = [
                'Simulateur'
            ];
        }

        elseif (
            str_contains($nomPrestation, 'conduite') ||
            str_contains($nomPrestation, 'pratique')
        ) {

            $typesRessources = [
                'Véhicule'
            ];
        }

        else {

            $typesRessources = [
                'Salle'
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VLOUNGE
    |--------------------------------------------------------------------------
    */

    elseif ($request->idService == 5) {

        if (
            str_contains($nomPrestation, 'écran') ||
            str_contains($nomPrestation, 'ecran') ||
            str_contains($nomPrestation, 'projecteur')
        ) {

            $typesRessources = [
                'Équipement audiovisuel'
            ];
        }

        elseif (str_contains($nomPrestation, 'dj')) {

            $typesRessources = [
                'Personnel / animation'
            ];
        }

        else {

            $typesRessources = [
                'Espace événementiel',
                'Espace privé'
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | COWORKING
    |--------------------------------------------------------------------------
    */

    elseif ($request->idService == 6) {

        if (
            str_contains($nomPrestation, 'conférence') ||
            str_contains($nomPrestation, 'conference')
        ) {

            $typesRessources = [
                'Salle'
            ];
        }

        elseif (str_contains($nomPrestation, 'bureau')) {

            $typesRessources = [
                'Bureau partagé',
                'Bureau individuel'
            ];
        }

        else {

            $typesRessources = [
                'Salle',
                'Bureau partagé',
                'Bureau individuel'
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Recherche d'une ressource libre
    |--------------------------------------------------------------------------
    */

    $ressources = Ressource::where('idService', $request->idService)
        ->where('etat', 'Disponible')
        ->whereIn('type', $typesRessources)
        ->get();

    $ressourceDisponible = null;

    foreach ($ressources as $ressource) {

        $conflit = $ressource->reservations()
            ->where('idReservation', '!=', $reservation->idReservation)
            ->where('date_reservation', $request->date_reservation)
            ->whereIn('statut', [
                'En_attente',
                'Confirmee'
            ])
            ->where(function ($query) use ($request) {

                $query->where(
                    'heure_debut',
                    '<',
                    $request->heure_fin
                )
                ->where(
                    'heure_fin',
                    '>',
                    $request->heure_debut
                );
            })
            ->exists();

        if (!$conflit) {

            $ressourceDisponible = $ressource;
            break;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Aucune ressource disponible
    |--------------------------------------------------------------------------
    */

    if (!$ressourceDisponible) {

        return back()
            ->withErrors([
                'ressource' =>
                    'Aucune ressource compatible n’est disponible pour ce nouveau créneau.'
            ])
            ->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Mise à jour de la réservation
    |--------------------------------------------------------------------------
    */

    $reservation->update([
        'date_reservation' => $request->date_reservation,
        'heure_debut' => $request->heure_debut,
        'heure_fin' => $request->heure_fin,
        'statut' => $request->statut,
        'canal_reservation' => $request->canal_reservation,
        'idClient' => $request->idClient,
        'idService' => $request->idService,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Mise à jour du détail
    |--------------------------------------------------------------------------
    */

    $detail = $reservation->detailReservations()->first();

    if ($detail) {

        $detail->update([
            'prix' => $prestation->prix,
            'idPrestation' => $prestation->idPrestation,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Remplacement de la ressource
    |--------------------------------------------------------------------------
    */

    $reservation->ressources()->sync([
        $ressourceDisponible->idRessource
    ]);

    return redirect()
        ->route('reservations.index')
        ->with(
            'success',
            'Réservation modifiée avec succès. Nouvelle ressource affectée : '
            . $ressourceDisponible->nom
        );
}

   public function destroy($id)
{
    $utilisateur = auth()->user();

    // L'employé ne peut pas annuler une réservation
    if ($utilisateur->role === 'Employe') {
        abort(
            403,
            'Accès refusé. Les employés ne peuvent pas annuler les réservations.'
        );
    }

    $reservation = Reservation::findOrFail($id);

    // Le Responsable ne peut annuler que les réservations de son service
    if (
        $utilisateur->role === 'Responsable'
        && $reservation->idService != $utilisateur->idService
    ) {
        abort(
            403,
            'Accès refusé. Vous ne pouvez annuler que les réservations de votre service.'
        );
    }

    // Une réservation déjà terminée ne peut pas être annulée
    if ($reservation->statut === 'Terminee') {
        return redirect()
            ->route('reservations.index')
            ->with(
                'error',
                'Une réservation terminée ne peut pas être annulée.'
            );
    }

    // Annulation de la réservation
    $reservation->update([
        'statut' => 'Annulee'
    ]);

    // Libération de la ressource
    $reservation->ressources()->detach();

    return redirect()
        ->route('reservations.index')
        ->with(
            'success',
            'Réservation annulée avec succès. La ressource a été libérée.'
        );
}
}