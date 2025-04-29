<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public $timestamps = false;
    protected $table = "notices";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "title",
        "subtitle",
        "photo",
        "content",
        "createTime"
    ];
}
