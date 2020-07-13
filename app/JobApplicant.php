<?php

namespace App;


use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class JobApplicant extends Model
{
    use UsesUuid;
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'job_applicants';
    protected $primaryKey = 'applicant_id';

}
