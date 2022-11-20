<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'date',
        'time',
        'notes_title',
        'task_id'
        
        
      
    ];

    use HasFactory;
    protected $table = "notes";

    public function images(){
        return $this->hasMany(Note_Image::class,'notes_id','id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class,'task_id','id');
    }
}
