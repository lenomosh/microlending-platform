<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Company extends Model
{
    protected $primaryKey = 'company_id';
    protected $table='companies';
    protected $guarded = '';
    protected $fillable = ['name','description','phone_number','location','field_id','email','logo'];
    public function jobs(){
        return $this->hasMany(Job::class,'company_id');
    }
    public function fields()
    {
        return $this->belongsToMany(Field::class,'company_field','field_id','company_id');
    }
    public function fieldDetails($field){
        $field = Field::find($field)->first();
        return $field;
    }
}
