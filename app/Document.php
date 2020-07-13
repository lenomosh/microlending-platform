<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded =[];
    use UsesUuid;
}
