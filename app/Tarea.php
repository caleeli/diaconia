<?php

namespace App;

use App\Traits\ModelValidation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use JDD\Api\Traits\AjaxFilterTrait;

/**
 * @method static Tarea find($id)
 * 
 */
class Tarea extends Model
{
    use ModelValidation;
    use AjaxFilterTrait;

    protected $table = 'tareas';
    protected $casts = [
        'entregable' => 'array',
        'entregable_fecha' => 'datetime',
        'vencimiento' => 'datetime'
    ];
    protected $fillable = ['nombre', 'entregable', 'entregable_fecha', 'vencimiento', 'estado', 'creador_id'];

    public function Users()
    {
        return $this->belongsToMany('App\User', 'tarea_usuario')->withTimestamps();
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

    public static function datosGantt()
    {
        $tareas = Tarea::with('users')->get();
        $lista = [];
        foreach ($tareas as $tarea) foreach ($tarea->users as $user) {
            $lista[] = [
                'id' => $tarea->id,
                'nombre' => $tarea->nombre,
                'usuario' => $user->name,
                'entregable' => $tarea->entregable,
                'entregable_fecha' => $tarea->entregable_fecha,
                'vencimiento' => $tarea->vencimiento,
                'estado' => $tarea->estado,
                'creador_id' => $tarea->creador_id,
                'fecha' => $user->pivot->created_at,
            ];
        }
        return $lista;
    }
}
