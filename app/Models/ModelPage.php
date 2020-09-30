<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPage extends Model
{
    //
    protected $table ='model_pages';
    protected $primaryKey ='id_page';

    public function relAccessPage(){
        return $this->belongsTo('App\Models\ModelAccessPage','id_page','page_id');
    }
}
