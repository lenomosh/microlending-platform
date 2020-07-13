<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $primaryKey='requirement_id';
    protected $table='requirements';
    protected $hidden = ['created_at','updated_at'];
    public function jobs(){
        return $this->belongsToMany(Job::class);
    }

}
