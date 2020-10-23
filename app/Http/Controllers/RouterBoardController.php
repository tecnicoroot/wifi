<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Mikrotik;

use App\API\Routeros_api;
use \PDF;


class RouterBoardController extends Controller
{
    
	private $mk = null;
  	private $routeros_api = null;
       

    public function __construct()
    {
        $this->mk = Mikrotik::get()->first();
        //dd($this->mk);
        $this->routeros_api = new Routeros_api();
    
    }

	/* Exibição das Páginas*/

    public function index(){
    	return view('routerboard.testeConexao');
    }

    public function routerBoardCadastroDeUsuarios(){
        $usuario = null;
        $usuarios = collect($this->procuraTodosUsuariosMikrotik(""))->sortBy("comment")->toArray();
        $pg = 1;
        $arquivos = $usuarios;
        $qtd = 10;
        if(isset($_GET['pg'])){
            $atual = $pg ? $_GET['pg'] : 1;
        }else{
            $atual = $_GET['pg'] = 1;
        }
        
        $pagArquivo = array_chunk($arquivos, $qtd);
        $contar = count($pagArquivo);
        if($atual < 1){
            $atual = 1;
        }
        if($atual > $contar-2){
            $atual = $contar;
        }
        $resultado = $pagArquivo[$atual-1];
        //dd($usuarios);
        return view('routerboard.cadastrodeusuarios', compact('usuario', 'usuarios','pg','atual','resultado',"contar"));
    }


    /*     Ações realizadas no Mikroitk  */

    public function conectar(){
        return $this->routeros_api->connect($this->mk->endereco,$this->mk->usuario, $this->mk->senha);
    }
    public function testeConexao() {

        if ($this->conectar()) {
            $this->routeros_api->write('/interface/print');
            $resultado = $this->routeros_api->read();
        

            $this->routeros_api->disconnect();
            return redirect()
                    ->route('routerboard.testeConexao')
                        ->with('success', 'Conexão realizada com sucesso!');
        } else {
        	return redirect()
                    ->route('routerboard.testeConexao')
                    ->with('error', 'Falha ao estabelecer conexão com o mikrotik!');
            
        }
    }

    public function validade() {
        date_default_timezone_set('UTC');
        $val = strtotime("+2 month");
        $validade = date("Y/m/d", $val);
		$validade = str_replace( "/", "", $validade);		
        return $validade;
    }

    public function geraNumeroAleatorio($quantidade) {
        $min = 100;
        $max = 5000;
		for ($i = 0; $i < $quantidade; $i++) {
            $gera[$i] = date("dm").rand($min,$max);
        }
        return $gera;
    }

    /*CRUD USUARIO MIKROTIK*/

    public function cadastraUsuariosMikrotik(Request $request){
    	$request->nome = strtoupper($request->nome);
		

        if ($this->conectar()) {
            
			if($request->perfil == "Temp")  {
                $request->validate([
                    'nome'                   => 'required',    
                    'perfil'                 => 'required|not_in:-1',


                ]);
				$this->routeros_api->comm("/ip/hotspot/user/add", array(
					"name"     		=> $request->nome,
					"profile" 		=> $request->perfil,
					"comment" 		=> $request->nome,
					
				
			   ));
			}else{
                $request->validate([
                    'nome'                   => 'required',
                    'mac'                    => 'required',
                    'perfil'                 => 'required|not_in:-1',
                ]);
			   $retorno = $this->routeros_api->comm("/ip/hotspot/user/add", array(
                
					"name"     		=> $request->mac,
					"password" 		=> "sabinjf",
					"mac-address" 	=> $request->mac,
					"profile" 		=>$request->perfil,
					"comment" 		=> $request->nome,
			   ));
			   
			}
            $listamac = $this->routeros_api->comm("/ip/hotspot/host/getall", array("?mac-address"=> $request->mac));
             
               if($listamac)
               {
                    $this->routeros_api->comm("/ip/hotspot/host/remove", array(
                        "numbers" => $listamac[0][".id"],
                    ));
               }
		   $this->routeros_api->disconnect();
		}
		if (isset($retorno['!trap'][0]['message'])){
			return redirect()
                ->route('routerboard.cadastrodeusuarios')
                ->with('error', 'Ocorreu um erro ao cadastrar o usuário, número mac já cadastrado.!');
							
		}else{
			return redirect()
                ->route('routerboard.cadastrodeusuarios')
                ->with('success', 'Usuário '.$request->nome.' Cadastrado com sucesso!');
		}
	}

    function procuraNomeUsuariosMikrotik(Request $request) {

        
        $lista = null;
        $usuarios = collect();
        $usuario =null;
        $pg = 1;
        if($request->nomepesquisa == null){
            return  redirect()->route('routerboard.cadastrodeusuarios');   
        }
    /*Tentar diminuir o tempo de espera*/
        if ($this->conectar()) {
            $lista = $this->routeros_api->comm("/ip/hotspot/user/getall", 
                array("?>profile" => "Cliente"));
           
            $this->routeros_api->disconnect();

            for ($i = 0; $i < count($lista); $i++) {

                if (preg_match("/^" . '.*'. strtoupper($request->nomepesquisa).'.*' . "/", $lista[$i]['comment']) !== 0) {
                    $usuario = collect($usuarios->push($lista[$i]))->toArray();
                }

            }
            /*   dd($usuarios);
            foreach($ids as $id){
               //dd($id);
                ($this->procuraIdUsuariosMikrotik($id));

                collect($this->procuraTodosUsuariosMikrotik(""))->sortBy("comment")->toArray();
            }
            */
       
        } 
        $usuarios = $usuario;
        
        $arquivos = $usuarios;
        $usuario = null;
        if($arquivos == null){
            return redirect()
            ->route('routerboard.cadastrodeusuarios')
            ->with('error', 'Não foi possivel localizar o nome digitado.');
        }
        $qtd = 10;
        if(isset($_GET['pg'])){
            $atual = $pg ? $_GET['pg'] : 1;
        }else{
            $atual = $_GET['pg'] = 1;
        }
        
        $pagArquivo = array_chunk($arquivos, $qtd);
        $contar = count($pagArquivo);
        if($atual < 1){
            $atual = 1;
        }
        if($atual > $contar-2){
            $atual = $contar;
        }
        $resultado = $pagArquivo[$atual-1];
        return view('routerboard.cadastrodeusuarios', compact('usuario', 'usuarios','pg','atual','resultado',"contar"));
    }

    public function procuraIdUsuariosMikrotik($pesquisa) {
        $lista = array();
               
        if ($this->conectar()) {

           $lista = $this->routeros_api->comm("/ip/hotspot/user/getall", array(
                "?.id" => $pesquisa));
        }
        $this->routeros_api->disconnect();
        return $lista;
    }
    public function procuraTodosUsuariosMikrotik($nomepesquisa = "") {
        $lista = array();
                
        if ($this->conectar()) {

           $lista = $this->routeros_api->comm("/ip/hotspot/user/getall", 
                array("?>profile" => "Cliente"));
        }
        $this->routeros_api->disconnect();
        return $lista;
    }
    public function procuraUsuariosTempMikrotik($nomepesquisa = "") {
        $lista = array();
                
        if ($this->conectar()) {

           $lista = $this->routeros_api->comm("/ip/hotspot/user/getall", 
                array("=profile" => "Temp"));
        }
        $this->routeros_api->disconnect();
        return $lista;
    }

     public function exibeUsuariosMikrotik($id)
    {
        $usuario = $this->procuraIdUsuariosMikrotik('*'.$id);
        $usuarios = collect($this->procuraTodosUsuariosMikrotik(""))->sortBy('comment');
        
        $usuarios = $usuario;
        
        $arquivos = $usuarios;
    
        if($arquivos == null){
            return redirect()
            ->route('routerboard.cadastrodeusuarios')
            ->with('error', 'Não foi possivel localizar o nome digitado.');
        }
        $qtd = 10;
        if(isset($_GET['pg'])){
            $atual = $pg ? $_GET['pg'] : 1;
        }else{
            $atual = $_GET['pg'] = 1;
        }
        
        $pagArquivo = array_chunk($arquivos, $qtd);
        $contar = count($pagArquivo);
        if($atual < 1){
            $atual = 1;
        }
        if($atual > $contar-2){
            $atual = $contar;
        }
        $resultado = $pagArquivo[$atual-1];
        return view('routerboard.cadastrodeusuarios', compact('usuario', 'usuarios','atual','resultado',"contar"));
    }

    public function atualizaUsuariosMikrotik($id, Request $request) {
        $request->nome = strtoupper($request->nome);
        if ($this->conectar()) {
        	if($request->perfil == "Temp")  {

        	$listamac = $this->routeros_api->comm("/ip/hotspot/host/getall", array("?name"=>$request->nome));
               
               if($listamac)
               {
                    $this->routeros_api->comm("/ip/hotspot/host/remove", array(
                        "numbers" => $listamac[0][".id"],
                    ));
               }
               
            $this->routeros_api->comm("/ip/hotspot/user/set", array(
                "comment" => $request->nome,
                "name" => $request->nome,
                
                "profile" =>$request->perfil,
                ".id" => $request->id));
            

	        $this->routeros_api->disconnect();
	        if (isset($retorno['!trap'][0]['message'])){
	            return redirect()
	                ->route('routerboard.cadastrodeusuarios')
	                ->with('error', 'Ocorreu um erro ao editar o usuário.');
	                            
	        }else{
	            return redirect()
	                ->route('routerboard.cadastrodeusuarios')
	                ->with('success', 'Usuário '.$request->nome.' atualizado com sucesso!');
	        }
        }else{
        	$listamac = $this->routeros_api->comm("/ip/hotspot/host/getall", array("?mac-address"=>$request->mac));
               
               if($listamac)
               {
                    $this->routeros_api->comm("/ip/hotspot/host/remove", array(
                        "numbers" => $listamac[0][".id"],
                    ));
               }
               
            $this->routeros_api->comm("/ip/hotspot/user/set", array(
                "comment" => $request->nome,
                "name" => $request->mac,
                "mac-address" => $request->mac,
                "profile" =>$request->perfil,
                ".id" => $request->id));
            

	        $this->routeros_api->disconnect();
	        if (isset($retorno['!trap'][0]['message'])){
	            return redirect()
	                ->route('routerboard.cadastrodeusuarios')
	                ->with('error', 'Ocorreu um erro ao editar o usuário.');
	                            
	        }else{
	            return redirect()
	                ->route('routerboard.cadastrodeusuarios')
	                ->with('success', 'Usuário '.$request->nome.' atualizado com sucesso!');
	        }
        }
     		
    }
    }    	
            
        
    

    function excluirCadastroClientesMikrotik($id, Request $request) {
        if ($this->conectar()) {
            
            $id = "*".$id; 
            $this->routeros_api->comm("/ip/hotspot/user/remove", array(
                ".id" => $id,
            ));
            $this->routeros_api->disconnect();
        }

        if (isset($retorno['!trap'][0]['message'])){
            return redirect()
                ->route('routerboard.cadastrodeusuarios')
                ->with('error', 'Ocorreu um erro ao excluir o usuário.');
                            
        }else{
            return redirect()
                ->route('routerboard.cadastrodeusuarios')
                ->with('success', 'Usuário '.$request->nome.' Exluído com sucesso!');
        }
    }

    /*CRUD BILHETES*/


    public function routerBoardCadastroDeBilhetes(){
        $bilhete = null;
        $bilhetes = collect($this->procuraTodosBilhetesMikrotik(""))->sortBy('comment');
        //dd($bilhetes);
        return view('routerboard.cadastrodebilhetes', compact('bilhete', 'bilhetes'));
    }

    public function procuraTodosBilhetesMikrotik(){
        $lista = array();
                
        if ($this->conectar()) {

           $lista = $this->routeros_api->comm("/ip/hotspot/user/getall", 
                array("?=profile" => "Cliente","?disabled"=>'yes'));
        }
        $this->routeros_api->disconnect();
        return $lista;
    }

    public function habilitarUsuariosMikrotik($id) {
        $bilhete = null;
        $array = array();
        if ($this->conectar()) {
            $this->routeros_api->comm("/ip/hotspot/user/enable", array('.id' => '*'.$id));
        }
        if ($this->conectar()) {
            $this->routeros_api->disconnect();

             $bilhete = $this->procuraIdUsuariosMikrotik('*'.$id);
        }    
            //dd($bilhete[0]['name']);

        return redirect()
                ->route('routerboard.cadastrodebilhetes')
                ->with('success', 'Usuário '.$bilhete[0]['name'].' habilitado com sucesso!');

    }

    public function procuraBilheteMikrotik(Request $request) {
        $lista = null;
        $bilhetes = collect();
        $bilhete =null;
    /*Tentar diminuir o tempo de espera*/
        if ($this->conectar()) {
            $lista = $this->routeros_api->comm("/ip/hotspot/user/getall", 
                array("?=profile" => "Cliente","?disabled"=>'yes'));
           
            $this->routeros_api->disconnect();

            for ($i = 0; $i < count($lista); $i++) {

                if (preg_match("/^" . '.*'.$request->nomepesquisa.'.*' . "/", $lista[$i]['name']) !== 0) {
                    $bilhetes->push($lista[$i]);
                }
            }
        } 
         return view('routerboard.cadastrodebilhetes', compact('bilhete', 'bilhetes'));
    }

    
     public function imprimeBilheteMikrotik() {
        $bilhete = null;
        $bilhetes = null;
        if ($this->conectar()) {
            $bilhetes = $this->routeros_api->comm("/ip/hotspot/user/getall", 
                array("?=profile" => "Cliente","?disabled"=>'yes'));

            $this->routeros_api->disconnect();
        }

        
        $pdf = PDF::loadView('bilhete.imprimebilhete', compact('bilhete', 'bilhetes'))->setPaper('a4')->setOrientation('landscape');
        return $pdf->download('bilhetes.pdf');

    }

    public function cadastrabilhetesmikrotik(Request $request) {
        $bilhetes = array();
        $request->validate([
            'quantidade'      => 'required|not_in:-1',
        ]);
        
        $numerobilhetes = $this->geraNumeroAleatorio($request->quantidade);
        //dd($numerobilhetes);

        if ($this->conectar()) {
            foreach ($numerobilhetes as $numerobilhete) {
                $bilhetes[]['name'] = $numerobilhete;
                $this->routeros_api->comm("/ip/hotspot/user/add", array(
                    "name" => $numerobilhete,
                    "password" => "",
                    "disabled" => "yes",
                    "profile" => "Cliente",
                    "comment" => $this->validade(),
                ));
            }
        }
        
        $this->routeros_api->disconnect();

        //dd($bilhetes);
    
        $pdf = PDF::loadView('bilhete.imprimebilhete', compact('bilhetes'))->setPaper('a4')->setOrientation('landscape');
        return $pdf->download('bilhetes.pdf');

    }

     
}
    
