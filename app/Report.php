<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'campaign_id', 'sent', 'received',
        'bounced', 'opened', 'blocked', 'subscribed'
    ];

    // Table Name
    protected $table = 'reports';

    // Primary Key
    public $primaryKey = 'report_id';

    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

}
