<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    public $timestamps = false;
    protected $table = "product_awards";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "productId",
        "level",
        "name",
        "totalCount",
        "stock",
        "createTime",
        "updateTime",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'Id');
    }
    // 與 `LotteryResult` 的關聯（一對一）
    public function lotteryResult()
    {
        return $this->hasOne(LotteryResult::class, 'awardsId', 'Id');
    }
}
