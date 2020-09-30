<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelStudent extends Model
{
    protected $table ='model_students';
    protected $primaryKey = 'id_student';

    protected $fillable = [
        'code_student',
        'people_id',
        'class_id',
        'state',
        'academic_year',
        'user_id',
        'contact_id',
        'created_at',
        'updated_at'
    ];

    /*public function relPeople(){
        return $this->belongsTo('App\Models\ModelPeople','people_id','id_people');
    }*/
    public function relPeople(){
        return $this->hasOne('App\Models\ModelPeople','id_people','people_id');
    }
    public function relClass(){
        return $this->belongsTo('App\Models\ModelClass','id_class','class_id');
    }
    public function relUser(){
        return $this->belongsTo('App\Models\ModelUsers','id','user_id');
    }
    public function relContacts(){
        return $this->hasMany('App\Models\ModelContact','id_contact','contact_id');
    }
    public function relBills(){
        return $this->hasMany('App\Models\ModelQuota','student_id','id_student');
    }
}
