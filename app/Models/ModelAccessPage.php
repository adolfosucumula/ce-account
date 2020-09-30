<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAccessPage extends Model
{
    //
    protected $table ='model_access_pages';
    protected $primaryKey ='id_access';

    public function relUser(){
        return $this->hasMany('App\Models\ModelUsers','id','user_id');
    }
    public function relPage(){
        return $this->hasMany('App\Models\ModelPage','id_page','page_id');
    }
}
