<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // 不是 Model
use Illuminate\Notifications\Notifiable;

class Player extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $table = "players";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "name",
        "nickName",
        "account",
        "password",
        "telephone",
        "address",
        "gender",
        "email",
        "birthdate",
        "point",
        "createTime",
        "updateTime",
        "role",
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'account';
    }
}
