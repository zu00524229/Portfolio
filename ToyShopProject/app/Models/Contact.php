<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $table = "contacts";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "name",
        "phone",
        "email",
        "message",
        "createTime"
    ];
}
