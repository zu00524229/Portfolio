<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
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
}
