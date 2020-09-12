<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'texto', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cambiarEstadoFalse($alertaId)
    {
        $this->estado = false;
        $this->save();
    }
}
