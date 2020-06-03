<?php

namespace App;

use App\Traits\ModelValidation;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use ModelValidation;

    protected $table = 'revisiones';
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function validation()
    {
        return [
        ];
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
