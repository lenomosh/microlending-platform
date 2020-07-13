<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $primaryKey = 'job_id';
    protected $hidden = ['created_at'];
    protected $fillable = ['deadline','title','description','location','skill_id','company_id','slots','responsibility','requirement_id','employment_period','other_information','salary'];
    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }
    public function requirements()
    {
        return $this->belongsToMany(Requirement::class);
    }
    public function period(){
        return $this->hasOne(Period::class,'id','employment_period');
    }
    public function applications(){
        return $this->hasMany(JobApplication::class,'job_id','job_id');
    }

}
