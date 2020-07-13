<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    public $incrementing = false;
    protected $table = 'payments';
    protected $keyType = 'string';
    protected $primaryKey = 'payment_id';
    use UsesUuid;
    public function transaction(){
        return $this->hasMany(Transaction::class,'transaction_id','transaction_id');
    }
    public function applications(){
        return $this->belongsTo(JobApplication::class,'application_id','application_id');
    }
}
