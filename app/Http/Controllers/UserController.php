<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\ModelUsers;

class UserController extends Controller
{
    private $objUser;

    public function __construct(){
        $this->objUser = new ModelUsers(); 
    }
    public function index()
    {
        if(Auth::check() === false){
            return view('templates.user.loginPage');
            
        }
        return redirect()->route('workerHome');
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
    public function dashboard(){
       
        if(Auth::check() === true){
            return redirect()->route('workerHome');
            
        }
        return redirect()->route('user.login');
    }
    public function doLogin(Request $request){
        
        if(!filter_var($request->inputEmail, FILTER_VALIDATE_EMAIL)){
            echo json_encode(['sms'=>'Digite um email válido!']);
        }else{
            $credentials = [
                'email'=>$request->inputEmail,
                'password'=>$request->inputPassword
            ];
    
            if(Auth::attempt($credentials)){

                $data = Auth::user();

                Session::put([
                    'id_user'=>$data->id,
                    'username'=>$data->name,
                    'email'=>$data->email,
                    'accessController'=>$this->objUser->find($data->id)->relAccessPages
                ]);
                
                echo json_encode(['rs'=>1]);
            }else{
                $data = [
                    'rs'=>0,
                    'sms'=>'Usuário e/ou senha errada!'
                ];
                echo json_encode($data);
            }
        }

    }
    public function makelogout(){
       
        Auth::logout();
        
        return redirect()->route('user.login');
        
    }
}
