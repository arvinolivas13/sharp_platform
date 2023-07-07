<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLogs extends Model
{
    protected $fillable = [
        'action',
        'details',
        'ip_address',
        'device_info',
        'workstation_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    
    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by() {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
