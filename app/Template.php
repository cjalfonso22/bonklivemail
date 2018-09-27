<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    // Table Name
    protected $table = 'templates';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
