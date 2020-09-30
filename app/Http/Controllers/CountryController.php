<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelCountry;

class CountryController extends Controller
{
    private $objCountry;

    public function __construct(){

        $this->objCountry = new ModelCountry();
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function getprovinces(Request $request){
        if(isset($request->id)){
            if($request->id  && $request->id >0){
                $p = $this->objCountry->find($request->id)->relProvince;
            
               echo json_encode(['data'=>$p]);
            
            }else{
                $data['data'] = "";
                echo json_encode($data);
            }
        }else{ 
            $data['data'] = "";
            echo json_encode($data);
        }
        
    }
}
