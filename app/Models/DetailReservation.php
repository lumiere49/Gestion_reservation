<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailReservation extends Model
{
    protected $table = 'detail_reservations';

    protected $primaryKey = 'idDetail';

    protected $fillable = [
        'quantite',
        'prix',
        'idReservation',
        'idPrestation'
    ];

    // Un détail appartient à une réservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'idReservation', 'idReservation');
    }

    // Un détail correspond à une prestation
    public function prestation()
    {
        return $this->belongsTo(Prestation::class, 'idPrestation', 'idPrestation');
    }
}
