<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'category_id',
        'type_equipment_id',
        'name',
        'equipment_number',
        'purchase_date',
        'insurance',
        'price',
        'user_id_created',
        'user_id_updated',
    ];

    public function TypeEquipment(){
        return $this->belongsTo(TypeEquipment::class);
    }
}
