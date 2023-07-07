<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'status',
        'sort_no',
        'workstation_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function apps() {
        return $this->hasMany(App::class, 'app_type_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
