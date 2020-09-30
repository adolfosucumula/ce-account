<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProvince extends Model
{
    //Define witch data table is related for
    protected $table ='model_provinces';
    protected $primaryKey = 'id_province';
    
    public function relCountry(){
        return $this->belongsTo('App\Models\ModelCountry','country_id','id_country');
    }
    public function relCity(){
        return $this->hasMany('App\Models\ModelCity','province_id','id_province');
    }
}
