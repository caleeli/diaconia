<?php

namespace App;

use App\Traits\ModelValidation;
use Illuminate\Database\Eloquent\Model;
use JDD\Api\Traits\AjaxFilterTrait;

class Plantilla extends Model
{
    use ModelValidation;
    use AjaxFilterTrait;

    protected $table = 'plantillas';
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function validation()
    {
        return [
            'name' => 'required',
        ];
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
