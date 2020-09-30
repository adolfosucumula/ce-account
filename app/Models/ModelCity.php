<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCity extends Model
{
    //Define witch data table is related for
    protected $table ='model_cities';
    protected $primaryKey = 'id_city';

    public function relProvince(){
        return $this->belongsTo('App\Models\ModelProvince','province_id','id_province');
    }
    public function relPeople(){
        return $this->belongsTo('App\Models\ModelPeople','id_city','city_id');
    }
}
