<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiements';

    protected $primaryKey = 'idPaiement';

    protected $fillable = [
        'montant',
        'date_paiement',
        'mode_paiement',
        'statut',
        'reference_paiement',
        'idReservation'
    ];

    // Un paiement appartient à une réservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'idReservation', 'idReservation');
    }
}
