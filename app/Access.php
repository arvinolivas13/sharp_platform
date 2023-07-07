<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Access extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'role_id',
        'permission_for',
        'permission_for_id',
        'enable',
        'add',
        'edit',
        'delete',
        'print',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
