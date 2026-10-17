<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'idUtilisateur';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'mot_de_passe',
        'role',
        'idService',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    /**
     * Un utilisateur appartient à un service.
     */
    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'idService',
            'idService'
        );
    }
    /**
 * Vérifie si l'utilisateur est administrateur général.
 */
public function estAdministrateur()
{
    return $this->role === 'Administrateur';
}

/**
 * Vérifie si l'utilisateur est responsable.
 */
public function estResponsable()
{
    return $this->role === 'Responsable';
}

/**
 * Vérifie si l'utilisateur est employé.
 */
public function estEmploye()
{
    return $this->role === 'Employe';
}

/**
 * Vérifie si l'utilisateur peut gérer les paiements.
 */
public function peutGererPaiements()
{
    return in_array($this->role, [
        'Administrateur',
        'Responsable'
    ]);
}
}