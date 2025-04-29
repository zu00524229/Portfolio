<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    public $timestamps = false;
    protected $table = "recharges";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "playerId",
        "paymentType",
        "point",
        "createTime",
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'playerId', 'Id');
    }
}