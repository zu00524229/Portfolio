<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = true;
    protected $table = 'contacts';
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'line',
        'subject',
        'message',

    ];
}
