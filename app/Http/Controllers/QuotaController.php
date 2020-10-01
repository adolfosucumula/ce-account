<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\ModelQuota;
use App\BusinessRule\QuotaRule;
use App\Models\ModelMonth;

class QuotaController extends Controller
{
    private $objQuota;
    private $objQuotaRule;
    private $objMonth;

    public function __construct(){

        $this->objQuota = new ModelQuota();
        $this->objQuotaRule = new QuotaRule();

    }
    public function index()
    {
        if(Auth::check()===true){
            $data = [
                'datalist'=>$this->objQuota->all()->sortByDesc('date_payment'),
                'title'=>'Pagamento de Propinas',
                'subtitle'=>'Lita Geral'
            ];
            
            return view('templates/payments/bills',$data); 
            
        }
        return redirect()->route('user.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()===true){

            $lastProccess = 1;

            if(count($this->objQuota->all()) > 0){
                $lastProccess = $this->objQuota->all()->last()->order_code + 1;
            }

            $data = [
                'datalist'=>$this->objQuota->all()->sortByDesc('date_payment'),
                'orderNumber'=>'00'.$lastProccess,
                'title'=>'Propinas',
                'subtitle'=>'Novo Pagamento'
            ];
            
            return view('templates/payments/payQuotation',$data); 
            
        }
        return redirect()->route('user.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()===true){
            
            $this->objQuota->setTicket($request->ticket);
            $this->objQuota->setTicketDate($request->ticketDate);
            $this->objQuota->setBank($request->bank);

            if($this->objQuotaRule->validateTicket($this->objQuota) > 0 ){
                return redirect()->back()->withInput()->withErrors(['O talão de pagamento já foi registado!']);
            }else{
                try {
                    
                    $rs = $this->objQuota->create([
                        'student_id'=>$request->idS,
                        'user_id'=>Auth::user()->id,
                        'price'=>$request->price,
                        'ticket'=>$request->ticket,
                        'ticket_date'=>$request->ticketDate,
                        'payment_method'=>$request->payMethod,
                        'bank'=>$request->bank,
                        'academic_year'=>$request->academicYear,
                        'quarter_reference'=>$request->reference,
                        'date_payment'=>date('Y-m-d'),
                        'month_payment'=>date('m'),
                        'day_payment'=>date('d'),
                        'signature'=>$request->signature,
                        'order_code'=>$request->order_number
                    ]);
        
                    if($rs){
                        return redirect('bills');
                    }else{
                        return redirect()->back()->withInput()->withErrors(['Falha ao cadastrar registo!']);
                        //return redirect('new_work'); 
                    }

                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->withInput()->withErrors(['Falha ao cadastrar registo!']);
                }
            }
            
        }
       return redirect()->route('user.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo 1;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::check()===true){
            
            $this->objQuota->setTicket($request->ticket);
            $this->objQuota->setTicketDate($request->ticketDate);
            $this->objQuota->setBank($request->bank);

            if($this->objQuotaRule->validateTicket($this->objQuota) > 0 ){
                return redirect()->back()->withInput()->withErrors(['O talão de pagamento já foi registado!']);
            }else{
                try {
                    
                    $rs = $this->objQuota->find($id)->update([
                        'student_id'=>$request->idS,
                        'user_id'=>Auth::user()->id,
                        'price'=>$request->price,
                        'ticket'=>$request->ticket,
                        'ticket_date'=>$request->ticketDate,
                        'payment_method'=>$request->payMethod,
                        'bank'=>$request->bank,
                        'academic_year'=>$request->academicYear,
                        'quarter_reference'=>$request->reference,
                        'date_payment'=>date('Y-m-d'),
                        'month_payment'=>date('m'),
                        'day_payment'=>date('d'),
                        'signature'=>$request->signature,
                        'order_code'=>$request->order_number
                    ]);
        
                    if($rs){
                        return redirect('bills');
                    }else{
                        return redirect()->back()->withInput()->withErrors(['Falha ao cadastrar registo!']);
                        //return redirect('new_work'); 
                    }

                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->withInput()->withErrors(['Falha ao cadastrar registo!']);
                }
            }
            
        }
       return redirect()->route('user.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getStudentQuota(Request $request){
        if(Auth::check()===true){
            
            $this->objMonth = new ModelMonth();

            $data = [
                'datalist'=>$this->objQuota->where('student_id',"{$request->code}")
                ->get()->sortBy('quarter_reference'),
                'monthsModel'=>$this->objMonth->months(),
                'title'=>'Propinas',
                'subtitle'=>'Historico'
            ];
            
           return view('templates/payments/quotation',$data); 
        }
        return redirect()->route('user.login');
    }
    public function editStudentQuota(Request $request){
        if(Auth::check()===true){
            
            $this->objMonth = new ModelMonth();

            $lastProccess = 1;

            if(count($this->objQuota->all()) > 0){
                $lastProccess = $this->objQuota->all()->last()->order_code + 1;
            }

           if(isset($request->code_quota)){
               if(is_array($request->code_quota)){
                   // echo $this->objQuota->all()->last()->order_code;
                    $data = [
                        'request'=>$request,
                        'datalist'=>$this->objQuota->where('student_id',"{$request->studentID}")
                        ->get()->sortBy('quarter_reference'),
                        'monthsModel'=>$this->objMonth->months(),
                        'orderNumber'=>'00'.$lastProccess,
                        'title'=>'Propinas',
                        'subtitle'=>'Atualizar Propina',
                        'action'=>2
                    ]; 
                    return view('templates/payments/payQuotation',$data); 
               }
           }else{
                return redirect()->route('stud')->withErrors(['Seleciona um mes para pagar!']);
           }
        }
        return redirect()->route('user.login');
    }
    public function updateStudentQuota(Request $request){

        if(Auth::check()===true){
            $this->objQuota->setTicket($request->ticket);
            $this->objQuota->setTicketDate($request->ticketDate);
            $this->objQuota->setBank($request->bank);
            $this->objQuota->setAcademicYear($request->academicYear);

            if($this->objQuotaRule->validateTicket($this->objQuota) > 0 ){
                return redirect()->back()->withInput()->withErrors(['O talão de pagamento já foi registado!']);
            }else{

                try {
                    $rs =0;
                    foreach($request->quotaID as $data){

                        $rs = $this->objQuota->find($data)->update([
                            'user_id'=>Auth::user()->id,
                            'price'=>$request->price,
                            'ticket'=>$request->ticket,
                            'ticket_date'=>$request->ticketDate,
                            'payment_method'=>$request->payMethod,
                            'bank'=>$request->bank,
                            'academic_year'=>$request->academicYear,
                            'date_payment'=>date('Y-m-d'),
                            'month_payment'=>date('m'),
                            'day_payment'=>date('d'),
                            'signature'=>$request->signature,
                            'order_code'=>$request->order_number,
                            'state'=>'ON',
                            'updated_at'=>date('Y-m-d H:i:s')
                        ]);
                    }

                    if($rs){
                        return redirect('quota');
                    }else{
                        return redirect()->back()->withInput()->withErrors(['Falha ao cadastrar registo!']);
                        //return redirect('new_work'); 
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        return redirect()->route('user.login');
    }
}
