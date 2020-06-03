<?php

namespace App;

use App\Traits\ModelValidation;
use Illuminate\Database\Eloquent\Model;
use JDD\Api\Traits\AjaxFilterTrait;

class Pregunta extends Model
{
    use ModelValidation;
    use AjaxFilterTrait;

    protected $table = 'plantilla_preguntas';
    protected $guarded = [];

    public function plantilla()
    {
        return $this->belongsTo(Plantilla::class);
    }

    public function validation()
    {
        return [
            'grupo' => 'required',
            'descripcion' => 'required',
        ];
    }
}
