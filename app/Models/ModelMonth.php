<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMonth extends Model
{
    
    public function months(){
        return array(
            ["month"=>"Janeiro","code"=>"1"],
            ["month"=>"Fevereiro","code"=>"2"],
            ["month"=>"Março","code"=>"3"],
            ["month"=>"Abril","code"=>"4"],
            ["month"=>"Maio","code"=>"5"],
            ["month"=>"Junho","code"=>"6"],
            ["month"=>"Julho","code"=>"7"],
            ["month"=>"Agosto","code"=>"8"],
            ["month"=>"Setembro","code"=>"9"],
            ["month"=>"Outubro","code"=>"10"],
            ["month"=>"Novembro","code"=>"11"],
            ["month"=>"Dezembro","code"=>"12"]
        );
    }
}
