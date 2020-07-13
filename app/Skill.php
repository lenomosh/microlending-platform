<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $primaryKey='skill_id';
    protected $table='skills';
    protected $hidden = ['created_at','updated_at'];
}
