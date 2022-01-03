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
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
