<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note_Image extends Model
{
    use HasFactory;

    protected $table ="notes_image";
    protected $guarded = [];


    public function expense()
    {
        return $this->belongsTo(Note::class,'notes_id','id');
    }
}
