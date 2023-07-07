<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleSetup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'role_id',
        'user_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    
    
    public function role() {
        return $this->belongsTo(Role::class, 'id', 'role_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
