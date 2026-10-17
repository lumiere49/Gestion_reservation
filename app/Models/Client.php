<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $primaryKey = 'idClient';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'mot_de_passe'
    ];

    public function reservations()
{
    return $this->hasMany(Reservation::class, 'idClient', 'idClient');
}
}
