<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Pagination\Paginator;


class UsuarioController extends Controller
{
    private $totalPage = 5;

    public function alterarDados($id)
    {
        $usuarios = $this->listaUsuarios();
      
        $usuario = User::where('id', $id)->get()->first();

    	return view('usuario.editarDadosUsuarioLogado', compact('usuario'));
    }

    public function alterarSenha(Request $request)
    {
        return view('usuario.trocasenha');
    }

    public function gravaSenha(Request $request, $id)
    {

        //dd($request);
        DB::beginTransaction();
        $request->validate([
            'senha'                  => 'required|confirmed',
            'senha_confirmation'     => 'required',
        ]);

         $usuario = User::find($id);
            $usuario->password     =  bcrypt($request->senha);
                        
            
        
        $usuario->save();


        if($usuario){
            DB::commit();            

            return redirect()
                    ->route('home') 
                    ->with('success', 'Senha atualizada com sucesso!');
            
        }else{
             DB::rollback();
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao atusalizar a senha.');
            
        }


    }
    
    public function exibeUsuarios()
    {
        $usuarios = $this->listaUsuarios();
        $usuario = null;
        
        return view ('usuario.exibecadastro', compact('usuarios','usuario','empresas'));
    }

    public function cadastraUsuario(Request $request)
    {
        

    	DB::beginTransaction();
    	$request->validate([
           
            'name'	                 => 'required',
			'email'	                 => 'required|email',
			'senha'	                 => 'required|confirmed',
			'senha_confirmation'	 => 'required',
			'perfil'	             => 'required|not_in:-1',
			'status'	             => 'required|not_in:-1',
				
        ]);

    	//dd($re);
    	$usuario = User::create([
            
			'name' 		=>  $request->name,
			'email'  			=>  $request->email,
			'idperfil'			=> $request->perfil,
			'password' 			=> bcrypt($request->senha),
			'tpstatus' 			=> $request->status,
			
        ]);


    	if($usuario){

    		DB::commit();

           
            return redirect()
                    ->back()
                    ->with('success', 'Usuário cadastrado com sucesso!');
            
    	}else{
    		 DB::rollback();
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao grvar o usuário.');
            
    	}
    	
    }

    public function apagarUsuario($id)
    {
        $usuario = User::find($id);
        //$usuario->softDeletes();
        $usuario->delete();

        return redirect()
                    ->route('exibe.usuarios')                    
                    ->with('success', 'Usuário removido com sucesso!');
    }

    public function listaUsuarios()
    {
        $usuarios = User::paginate($this->totalPage);
        return $usuarios;
    }

    
    public function procuraUsuario(Request $request)
    {
        //dd($request->nomepesquisa);
        $usuarios = User::where('name', 'LIKE', '%'.$request->nomepesquisa.'%')->paginate($this->totalPage);
        $usuario = null;
        //dd($usuarios);
        return view ('usuario.exibecadastro', compact('usuarios', 'usuario'));
    }

    public function editaUsuario(Request $request, $id)
    {
        //dd($request);
        DB::beginTransaction();
            if($request->perfil && $request->status){
                $request->validate([
               
                'name'                   => 'required',
                'email'                  => 'required|email',
                'perfil'                 => 'required|not_in:-1',
                'status'                 => 'required|not_in:-1',
                    
            ]);
            }else{
                $request->validate([
           
                    'name'                   => 'required',
                    'email'                  => 'required|email',
                    
                        
                ]);
            }
        

        //dd($re);
        $usuario = User::find($id);
        //dd($request->status);
        if($request->perfil || $request->status){
            
            $usuario->name     =  $request->name;
            $usuario->email       =  $request->email;
            $usuario->idperfil      = $request->perfil;
            $usuario->tpstatus      = $request->status;
        }else{
           
            $usuario->name     =  $request->name;
            $usuario->email       =  $request->email;
            
        }    
            
       
        $usuario->save();


        if($usuario){
            DB::commit(); 
            if($request->perfil && $request->status){
                return redirect()
                    ->route('exibe.usuarios') 
                    ->with('success', 'Dados atualizados com sucesso!');
                    
            
            }else{
                
           
                    return redirect()
                    ->route('home') 
                    ->with('success', 'Dados atualizados com sucesso!');
                    
                        
                
            }           
            
            
            
        }else{
             DB::rollback();
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao atusalizar os dados o usuário.');
            
        }
    }

    public function exibeUsuario($id)
    {
        $usuarioEmpresaSelecionada = [];  
        $usuarios = $this->listaUsuarios();
        

        
       //dd($empresas->usuarios);
        $usuario = User::where('id', $id)->get()->first();
        //dd($usuario->empresas);
                    
        return view ('usuario.exibecadastro', compact('usuarios','usuario'));
    }

}
