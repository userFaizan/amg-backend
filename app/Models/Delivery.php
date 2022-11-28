<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'description',
        'signature_img'  
    ];

    use HasFactory;
    protected $table = "delivery";

    public function images(){
        return $this->hasMany(Delivery_Image::class,'delivery_id','id');
    }
}
