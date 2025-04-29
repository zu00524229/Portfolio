<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotteryResult extends Model
{
    public $timestamps = false;
    protected $table = "lottery_results";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "playerId",
        "awardsId",
        "enableShip",
        "createTime"
    ];

    public function awards()
    {
        return $this->belongsTo(Awards::class, 'awardsId', 'Id');
    }
    public function player()
    {
        return $this->belongsTo(player::class, 'playerId', 'Id');
    }
}
