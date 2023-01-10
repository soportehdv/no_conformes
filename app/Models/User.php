<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cargo',
        'email',
        'password',
        'rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image(){
        $files = Files::all();
        foreach($files as $file){
            if($file->id == auth()->user()->image){
                return  asset('files/biblioteca/' . $file->ruta);
            }
        }
    }

    public function adminlte_desc(){
        return auth()->user()->rol;
    }

    public function adminlte_profile_url(){

        return 'misDatos/';
    }

    public function Nconformes(){
        return $this->hashMany('App\Models\Nconforme');
    }
 }
