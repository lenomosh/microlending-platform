<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use UsesUuid;
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'job_applications';
    protected $primaryKey = 'application_id';
//    public function getcodes($id){
//
//    }
    public function payment(){
        return $this->hasOne(Payment::class,'application_id','application_id');
    }
    public function applicant(){
        return $this->hasOne(JobApplicant::class,'applicant_id','applicant_id');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class,'application_id','application_id');
    }
    public function job(){
        return $this->belongsTo(Job::class,'job_id','job_id');
    }
}
