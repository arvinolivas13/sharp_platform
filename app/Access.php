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
        'add',
        'edit',
        'delete',
        'print'
    ];
}
