<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    protected $table = 'ressources';

    protected $primaryKey = 'idRessource';

    protected $fillable = [
        'nom',
        'type',
        'etat',
        'capacite',
        'description',
        'idService'
    ];

    // Une ressource appartient à un service
    public function service()
    {
        return $this->belongsTo(Service::class, 'idService', 'idService');
    }

    public function reservations()
{
    return $this->belongsToMany(
        Reservation::class,
        'reservation_ressource',
        'idRessource',
        'idReservation'
    );
}
}
