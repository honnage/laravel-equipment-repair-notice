<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEquipment extends Model
{
    // use HasFactory;
    protected $table = "type_equipment";
    protected $fillable = [
        'category_id',
        'name',
        'user_id_created',
        'user_id_updated',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function TypeEquipment(){
        return $this->hasMany(TypeEquipment::class, 'category_id');      
    }

}
