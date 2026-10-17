<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'idService';

    protected $fillable = [
    'nom',
    'description',
    'telephone',
    'adresse',
    'heure_ouverture',
    'heure_fermeture',
];

    // Un service peut avoir plusieurs ressources
    public function ressources()
    {
        return $this->hasMany(Ressource::class, 'idService', 'idService');
    }

    // Un service peut avoir plusieurs prestations
    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'idService', 'idService');
    }
    /**
 * Un service peut avoir plusieurs utilisateurs.
 */
public function utilisateurs()
{
    return $this->hasMany(
        Utilisateur::class,
        'idService',
        'idService'
    );
}
}
