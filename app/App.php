<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $table = 'app_data';
    protected $guarded = '';
    protected $primaryKey = 'id';
    protected $fillable = ['name','location','description','logo','favicon','facebook','twitter','instagram','privacy','terms','email','phone'];
    protected $hidden = ['created_at','updated_at'];
}
