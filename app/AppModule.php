<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModule extends Model
{
    protected $fillable = [
        'name',
        'code',
        'app_id',
        'sort_no',
        'workstation_id',
        'status',
        'created_by',
        'updated_by'
    ];

    public function app() {
        return $this->belongsTo(App::class);
    }
}
