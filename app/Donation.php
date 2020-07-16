<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $table = 'donations';

    public function org()
    {
        return $this->hasOne('App\Org', 'id', 'org_id');
    }
}
