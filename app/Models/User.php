<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $data = [
        'nombres',
        'curp',
        'prim_apell', 
        'email', 
        'id_ent',

        // 'curpIndexFile1',
        // 'folioIndexFile1',
        // 'nombresIndexFile1',
        // 'primer_apellidoIndexFile1',
        // 'segundo_apellidoIndexFile1',
        // 'cve_entidadIndexFile1',
        // 'qna_inicioIndexFile2'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
