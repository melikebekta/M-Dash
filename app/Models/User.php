<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    protected $table = "admin";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    public function getUser(){
        return $this->hasOne('App\Models\User','id','user_id');
     } 
}
