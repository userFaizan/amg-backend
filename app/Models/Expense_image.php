<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense_image extends Model
{
    use HasFactory;

    protected $table ="expense_image";
    protected $guarded = [];


    public function expense()
    {
        return $this->belongsTo(Expense::class,'expense_id','id');
    }
}
