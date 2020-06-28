<?php

namespace App;

use App\Traits\ModelValidation;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use ModelValidation;

    protected $table = 'tareas';
    protected $casts = [
        'entregable' => 'array',
        'entregable_fecha' => 'datetime',
        'vencimiento' => 'datetime'
    ];
    protected $fillable = ['nombre', 'entregable', 'entregable_fecha', 'vencimiento', 'estado', 'creador_id'];
    public function Users()
    {
        return $this->belongsToMany('App\User');
    }
    public function todosUsuarios()
    {
        $result = User::pluck('id')->toArray();
        return $result;
    }
    public function setEntregableAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['entregable_fecha'] = Carbon::now();
        }
        if (is_array($value)) {
            $this->attributes['entregable'] = json_encode($value);
        } else {
            $this->attributes['entregable'] = $value;
        }
    }
    public function validation()
    {
        return [
            'nombre' => 'required',
            'estado' => 'required',
            'creador_id' => 'required',
        ];
    }
}
