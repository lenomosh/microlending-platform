<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use UsesUuid;
    protected $table = 'transactions';
    public $incrementing = false;
    protected $primaryKey = 'transaction_id';
    protected $keyType = 'string';
    protected $guarded = [];
    public function payment(){
        return $this->belongsTo(Payment::class,'transaction_id','transaction_id');
    }

}
