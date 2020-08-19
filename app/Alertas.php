<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alertas extends Model
{
    protected $table = 'alertas';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
