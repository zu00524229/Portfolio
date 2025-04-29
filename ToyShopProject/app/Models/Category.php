<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = "product_category";
    protected $primaryKey = "Id";
    protected $fillable = [
        "Id",
        "name",
        "createTime",
        "updateTime",
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'categoryId', 'Id');
    }
}
