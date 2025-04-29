<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
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
    ];

    // 與 `recharges` 的關聯（一對一）
    public function recharge()
    {
        return $this->hasOne(Recharge::class, 'playerId', 'Id');
    }
    // 與 `LotteryResult` 的關聯（一對一）
    public function lotteryResult()
    {
        return $this->hasOne(LotteryResult::class, 'playerId', 'Id');
    }
    // 與 `shipping` 的關聯（一對一）
    public function shipping()
    {
        return $this->hasOne(Shipping::class, 'playerId', 'Id');
    }
}
