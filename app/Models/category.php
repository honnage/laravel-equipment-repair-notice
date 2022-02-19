<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id_created',
        'user_id_updated',
    ];

    // public function TypeEquipment(){
    //     return $this->hasMany(TypeEquipment::class, 'category_id');      
    // }

    public function Equipment(){
        return $this->hasMany(Equipment::class, 'category_id');      
    }
}
