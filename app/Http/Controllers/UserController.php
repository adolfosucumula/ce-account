<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\ModelUsers;
use App\Models\ModelAccessPage;

class UserController extends Controller
{
    private $objUser;

    public function __construct(){
        $this->objAccess = new ModelAccessPage();
        $this->objUser = new ModelUsers(); 
    }
    public function index()
    {
        if(Auth::check() === false){
            return view('templates.user.loginPage');
            
        }
        return redirect()->route('home');
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
        
        $valid = $request->validate([
            'Email'=>'required|email',
            'Password'=>'required'
        ]);
        
        if(!filter_var($request->Email, FILTER_VALIDATE_EMAIL)){
            echo json_encode(['sms'=>'Digite um email válido!']);
        }else{
            $credentials = [
                'email'=>$request->Email,
                'password'=>$request->Password
            ];
          
            if(Auth::attempt($credentials)){

               $accesses = $this->objAccess->where('user_id',Auth::user()->id)->get();

               if(count($accesses) > 0){
                    foreach($accesses as $access){
                        foreach($access->relPage as $page)
                        {
                            Session::push('AccessPage',
                                array('code'=>$access->id_access,'page'=>$page->page,
                                    'pageID'=>$access->page_id,'userID'=>$access->user_id,
                                    'allowed'=>$access->allowed,'insert'=>$access->insert_,
                                    'update'=>$access->update_,'delete'=>$access->delete_,
                                    'select'=>$access->select_
                                    )
                            );
                        }
                    }
                }
                
                //echo json_encode(['rs'=>1]);
                return redirect()->route('home');
                
            }else{
                $data = [
                    'rs'=>0,
                    'sms'=>'Usuário e/ou senha errada!'
                ];
                //echo json_encode($data);
                return redirect()->back()->withInput()->withErrors(['Usuario e/ou senha errada!']);
            }
            
        }

    }
    public function makelogout(){
       
        Auth::logout();
        
        return redirect()->route('user.login');
        
    }
}
