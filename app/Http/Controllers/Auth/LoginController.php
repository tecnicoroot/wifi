<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        //dd($request);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        

        $credentials = ['email' => $request->email, 'password' => $request->password, 'tpstatus' =>1 ];
        //dd($credentials['tpstatus']);
        if(Auth::attempt($credentials)){
            
            return redirect()->intended('home');
        }else{
            $user = User::where('email', $request->email)->get()->first();
            if($user){
                if($user->tpstatus == 0){
              
                return redirect()->back()->with('msg','Usuário está desabilitado, entre em contato com o setor responsável'); 
                }
            }
            
                
                return redirect()->back()->with('msg','Acesso negado para estas credenciais ou usuário não existe.');
            }
            
        
                
    }
}
