<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    protected $fillable = [
        'date',
        'time',
        'expense_type',
        'expense_bill',
        'task_id'
        
      
    ];

    use HasFactory;
    protected $table = "expenses";

    public function images(){
        return $this->hasMany(Expense_image::class,'expense_id','id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class,'task_id','id');
    }
}
