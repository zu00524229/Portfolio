<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Manager extends Authenticatable
{
    public $timestamps = false;
    protected $table = "managers";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "name",
        "account",
        "password",
        "createTime",
        "updateTime",
    ];

    public function username()
    {
        return 'account';
    }
}
