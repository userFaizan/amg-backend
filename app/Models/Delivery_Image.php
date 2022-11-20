<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery_Image extends Model
{
    use HasFactory;
    protected $table ="delivery_image";
    protected $guarded = [];


    public function expense()
    {
        return $this->belongsTo(Delivery::class,'delivery_id','id');
    }
}
