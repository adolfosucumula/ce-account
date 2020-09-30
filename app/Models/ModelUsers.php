<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelUsers extends Model
{
    protected $table ='users';
    protected $primaryKey ='id';

    public function relAccessPages(){
        return $this->belongsTo('App\Models\ModelAccessPage','id','user_id');
    }
}
