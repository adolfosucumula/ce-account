<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\ModelPeople;
use App\Models\ModelIdentity;
use App\Models\ModelRegistration;
use App\Models\ModelCity;
use App\Models\ModelProvince;
use App\Models\ModelCountry;
use App\Models\ModelCategory;
use App\Models\ModelClass;
use App\Models\ModelCourse;

class RegistrationController extends Controller
{   
    private $objPeople;
    private $objIdentity;
    private $objRegist;
    private $objCity;
    private $objProvince;
    private $objCountry;
    private $objClass;
    private $objCourse;
    
    public function __construct(){
        $this->middleware('auth');

        $this->objPeople = new ModelPeople();
        $this->objIdentity = new ModelIdentity();
        $this->objRegist = new ModelRegistration();
        $this->objCity = new ModelCity();
        $this->objProvince = new ModelProvince();
        $this->objCountry = new ModelCountry();
        $this->objClass = new ModelClass();
        $this->objCourse = new ModelCourse();

    }
    public function index()
    {   
        $data = [
            'datalist'=>$this->objRegist->paginate(10),
            'title'=>'Matriculados',
            'subtitle'=>'Lita Geral'
        ];
        return view('templates.enroll.enrolled',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastProccess = 1;

            if(count($this->objRegist->all()) > 0){
                $lastProccess = $this->objRegist->all()->last()->order_code + 1;
            }

        $data = [
            'newProccess'=>'00'.$lastProccess,
            'title'=>'Matriculados',
            'subtitle'=>'Novo registo',
            'action'=>1,
            'coutryList'=>$this->objCountry->all()->sortByDesc('id_country'),
            'provinceList'=>$this->objProvince->all()->sortByDesc('id_province'),
            'cityList'=>$this->objCity->all()->sortByDesc('id_city'),
            'classList'=>$this->objClass->all(),
            'coursesList'=>$this->objCourse->all()
        ];
        return view('templates.enroll.enroll',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $i = $this->objIdentity->create([
                'identity'=>$request->identity,
                'exp_date'=>$request->expdate
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            //throw $e;
            return Redirect::back()
            ->withErrors( $e->getErrors() )
            ->withInput();
        }
        try {
            $p = $this->objPeople->create([
                'firstname'=>$request->firstName,
                'lastname'=>$request->lastName,
                'gender'=>$request->gender,
                'm_state'=>$request->mstate,
                'nationality'=>$request->nationality,
                'city_id'=>$request->city,
                'identity_code'=>$i->id_identity
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            //throw $e;
            return Redirect::back()
            ->withErrors( $e->getErrors() )
            ->withInput();
        }
       /* try {
            $p = $this->objRegist->create([
                'people_id'=>$p->id_people,
                'user_id'=>Auth::user()->id,
                'level'=>$request->gender,
                'course'=>$request->mstate,
                'class'=>$request->nationality,
                'grade'=>$request->city,
                'price'=>$i->id_identity,
                'ticket'=>$i->id_identity,
                'ticket_date'=>$i->id_identity
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            //throw $e;
            return Redirect::back()
            ->withErrors( $e->getErrors() )
            ->withInput();
        }*/

        DB::commit();

        return Redirect::route('enrolls');
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
        //
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
        //
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
}
