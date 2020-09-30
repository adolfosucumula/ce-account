<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelClass extends Model
{
    //
    protected $table ='model_classes';
    protected $primaryKey = 'id_class';

    public function relCategory(){
        return $this->belongsTo('App\Models\ModelCategoryCourse','id_category','category_id');
    }
    public function relCourse(){
        return $this->belongsTo('App\Models\ModelCourse','id_course','course_id');
    }
    public function relGrade(){
        return $this->hasOne('App\Models\ModelGrade','id_grade','grade_id');
    }
}
