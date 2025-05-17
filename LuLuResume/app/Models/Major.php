<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public $timestamps = false;
    protected $table = 'majors';
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'majorId',
        'name',
        'photo',
        'content',
        'createTime',
        'updateTime',
    ];


    // 關聯MajorCategory 的 majorId
    public function majorCategory()
    {
        return $this->belongsTo(MajorCategory::class, 'majorId', 'id');
    }
}
