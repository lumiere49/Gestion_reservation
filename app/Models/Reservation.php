<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $primaryKey = 'idReservation';

    protected $fillable = [
    'date_reservation',
    'heure_debut',
    'heure_fin',
    'statut',
    'canal_reservation',
    'idClient',
    'idService',
    'idUtilisateur'
];

    // Une réservation appartient à un client
    public function client()
    {
        return $this->belongsTo(Client::class, 'idClient', 'idClient');
    }
    // Une réservation appartient à un service
public function service()
{
    return $this->belongsTo(Service::class, 'idService', 'idService');
}
    //une réservation peut contenir plusieurs détails de réservation
    public function detailReservations()
{
    return $this->hasMany(DetailReservation::class, 'idReservation', 'idReservation');
}

public function paiements()
{
    return $this->hasMany(
        Paiement::class,
        'idReservation',
        'idReservation'
    );
}

public function ressources()
{
    return $this->belongsToMany(
        Ressource::class,
        'reservation_ressource',
        'idReservation',
        'idRessource'
    );
}

public function ressourcesParService($idService)
{
    $ressources = Ressource::where('idService', $idService)
        ->where('etat', 'Disponible')
        ->get();

    return response()->json($ressources);
}

}
