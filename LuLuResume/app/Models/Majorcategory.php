<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Majorcategory extends Model
{
    public $timestamps = false;
    protected $table = 'majorcategories';
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'name',
        'createTime',
        'updateTime',
    ];

    public function Majors()
    {
        return $this->hasMany(Major::class, 'majorId', 'id');
    }
}
