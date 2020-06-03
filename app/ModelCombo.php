<?php

namespace App;

use App\Traits\ModelValidation;
use JDD\Api\Traits\AjaxFilterTrait;

class ModelCombo extends Model
{
    use ModelValidation;
    use AjaxFilterTrait;

    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
