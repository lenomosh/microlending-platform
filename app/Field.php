<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'fields';
    protected $primaryKey = 'field_id';
    protected $hidden = ['created_at','updated_at'];
    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_field','company_id','field_id');
    }
}
