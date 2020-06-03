<?php

namespace App;

use App\Traits\ModelValidation;
use Illuminate\Database\Eloquent\Model;
use JDD\Api\Traits\AjaxFilterTrait;

class Respuesta extends Model
{
    use ModelValidation;
    use AjaxFilterTrait;

    protected $table = 'respuestas';
    protected $guarded = [];

    public function revision()
    {
        return $this->belongsTo(Revision::class);
    }

    public function validation()
    {
        return [
        ];
    }
}
