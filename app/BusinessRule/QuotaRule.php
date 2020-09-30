<?php

namespace App\BusinessRule;

use Illuminate\Database\Eloquent\Model;

use App\Models\ModelQuota;

class QuotaRule extends Model
{
    public function validateTicket(ModelQuota $quota){

        $rs = $quota->where('bank',"{$quota->getBank()}")
        ->where('ticket',"{$quota->getTicket()}")
        ->where('ticket_date',"{$quota->getTicketDate()}")
        ->get();

        return count($rs);
    }
}
