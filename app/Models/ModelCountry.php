<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCountry extends Model
{
    //
    protected $table ='model_countries';
    protected $primaryKey = 'id_country';

    public function relProvince(){
        return $this->hasMany('App\Models\ModelProvince','country_id','id_country');
    }
}
