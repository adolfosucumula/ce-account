<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelQuota extends Model
{
    //
    protected $table ='model_quotas';
    protected $primaryKey = 'id_quota';
    protected $fillable = [
        'student_id',
        'user_id',
        'price',
        'ticket',
        'ticket_date',
        'payment_method',
        'bank',
        'academic_year',
        'quarter_reference',
        'date_payment',
        'month_payment',
        'day_payment',
        'signature',
        'order_code',
        'state',
        'created_at',
        'updated_at'
    ];

    private $id;
    private $ticket;
    private $ticketDate;
    private $bank;
    private $academicYear;

    public function getId(){ return $this-> id; }
    public function setId($id){ $this-> id = $id; }
    
    public function getTicket(){ return $this-> ticket; }
    public function setTicket($ticket){ $this-> ticket = $ticket; }

    public function getTicketDate(){ return $this-> ticketDate; }
    public function setTicketDate($ticketDate){ $this-> ticketDate = $ticketDate; }

    public function getBank(){ return $this-> bank; }
    public function setBank($bank){ $this-> bank = $bank; }

    public function getAcademicYear(){ return $this-> academicYear; }
    public function setAcademicYear($academicYear){ $this-> academicYear = $academicYear; }

    public function relStudent(){
        return $this->belongsTo('App\Models\ModelStudent','student_id','id_student');
    }
}
