<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id',
        'name',
        'problem',
        'category',
        'details',
        'status',
        'note',
        'price',
        'fileImage',
        'guaranty',
        'set_at',
    ];
}
