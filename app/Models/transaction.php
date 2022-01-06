<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'code',
        'problem',
        'equipment_id',
        'details',
        'status',
        'fileImage',
        'price',
        'guaranty',
        'set_at',
        'user_id_created',
        'user_id_updated',
    ];

    public function Equipment(){
        return $this->belongsTo(Equipment::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    // public function user(){
    //     return $this->hasOne(User::class, 'id','user_id');
    // }
}
