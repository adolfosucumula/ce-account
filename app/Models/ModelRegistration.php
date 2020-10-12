<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelRegistration extends Model
{
    protected $table="model_registrations";
    protected $primaryKey ="id_registration";

    protected $fillable = [
        'people_id',
        'user_id',
        'level',
        'course',
        'class',
        'grade',
        'price',
        'ticket',
        'ticket_date',
        'payment_method',
        'bank',
        'academic_year',
        'date_payment',
        'month_payment',
        'day_payment',
        'signature',
        'order_code',
        'created_at',
        'updated_at'
    ];
}
