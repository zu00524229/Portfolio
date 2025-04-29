<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = "products";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "name",
        "content",
        "point",
        "photo",
        "categoryId",
        "totalCount",
        "stock",
        "shippingDays",
        "shippingDate",
        "createTime",
        "updateTime",
    ];

    // 與 `Catagory` 的關聯（多對一）
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'Id');
    }
    // 與 `Awards` 的關聯（一對一）
    public function award()
    {
        return $this->hasOne(Awards::class, 'productId', 'Id');
    }
}
