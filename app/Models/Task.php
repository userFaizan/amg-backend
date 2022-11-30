<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'driver_id',
        'shipment_id',
        'refrence_id',
        'pickup_location',
        'drop_off_location',
        'dilivary_date',
        'time',
        'contact_number',
        'total_distance',
        'total_weight',
        'vehicle_id',
        'vehicle_type',
        'dispatcher',
        'shipper',
        'total_cost',
        'payment_status',
        "shipment_status",
        "pickup_lat",
        "pickup_lng",
        'drop_lat',
        'drop_lng'
    ];

    use HasFactory;
    protected $table = "tasks";

    public function shipment()
    {
        return $this->belongsTo(Shipment::class,'shipment_status');
    }

    
    public function expense(){
        return $this->hasMany(Expense::class,'task_id','id');
    }

    public function note(){
        return $this->hasMany(Note::class,'task_id','id');
    }
    public function delivery(){
        return $this->hasMany(Delivery::class,'task_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'driver_id');
    }
}
