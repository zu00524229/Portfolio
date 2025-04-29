<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;
    protected $table = "shippings";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "playerId",
        "lotteryIds",
        "arrivalDate",
        "createTime"
    ];

    public function player()
    {
        return $this->belongsTo(player::class, 'playerId', 'Id');
    }
}
