<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'sort_no',
        'app_type_id',
        'status',
        'module',
        'work_station_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function app_modules() {
        return $this->hasMany(AppModule::class, 'app_id', 'id');
    }
    
    public function app_type() {
        return $this->belongsTo(AppType::class);
    }
    
    public function access() {
        return $this->belongsTo(Access::class, 'id', 'permission_for_id')->where('accesses.permission_for', 'apps')->where('accesses.role_id', auth()->user()->access->role_id);
    }
}
