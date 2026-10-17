<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
     protected $table = 'prestations';

    protected $primaryKey = 'idPrestation';

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'duree',
        'idService'
    ];

    // Une prestation appartient à un service
    public function service()
    {
        return $this->belongsTo(Service::class, 'idService', 'idService');
    }

    // Une prestation peut apparaître dans plusieurs détails de réservation
    public function detailReservations()
    {
        return $this->hasMany(DetailReservation::class, 'idPrestation', 'idPrestation');
    }
    
}
