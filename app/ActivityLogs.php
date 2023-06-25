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
}
