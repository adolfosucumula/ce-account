<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelIdentity extends Model
{
    //
    protected $table = 'model_identities';
    protected $primaryKey = 'id_identity';
    protected $fillable = [
        'identity',
        'exp_date'
    ];

    public function relPeople(){
        return $this->belongsTo('App\Models\ModelPeople','id_identity','identity_code');
    }
}
