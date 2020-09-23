<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';
    protected $primaryKey = 'id';
    protected $casts = [
        'no_leido' => 'bool',
    ];
    protected $fillable = [
        'texto', 'user_id', 'no_leido'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cambiarNoLeidoFalse()
    {
        $this->no_leido = false;
        $this->save();
    }
}
