<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelGrade extends Model
{
    protected $table ='model_grades';
    protected $primaryKey = 'id_grade';

    public function relClass(){
        return $this->belongsTo('App\Models\ModelClass','id_grade','grade_id');
    }
}
