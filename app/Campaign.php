<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    // Table Name
    protected $table = 'campaigns';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function report(){
        return $this->hasOne('App\Report');
    }

}
