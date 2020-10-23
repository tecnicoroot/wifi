<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Model\Mikrotik;
use Carbon\Carbon;

use App\API\Routeros_api;

class MikrotikController extends Controller
{
    private $totalPage = 5;
  	
  	public function exibeMikrotiks()
    {
    	 
        $mikrotiks = $this->listaMikrotiks();
        $mikrotik = null;
        return view ('mikrotik.exibemikrotik', compact('mikrotiks','mikrotik'));
    }

    public function cadastraMikrotik(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'endereco'               => 'required',
            'usuario'                => 'required',
            'senha'                  => 'required',
            'descricao'              => 'required',
        ]);
        //dd($re);
        $mikrotik = Mikrotik::create([
            'endereco'       =>  $request->endereco,
            'usuario'        =>  $request->usuario,
            'senha'          => $request->senha,
            'descricao'      => $request->descricao,
        ]);

        if($mikrotik){
            DB::commit();
            return redirect()
                    ->back()
                    ->with('success', 'Mikrotik cadastrado com sucesso!');
        }else{
             DB::rollback();
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao grvar o Mikrotik.');
        }
    }

    public function apagarMikrotik($id)
    {
        $mikrotik = Mikrotik::find($id);
        $mikrotik->delete();
        return redirect()
                    ->route('exibe.mikrotiks')                    
                    ->with('success', 'Mikrotik removido com sucesso!');
    }

    public function listaMikrotiks()
    {
        $mikrotiks = Mikrotik::paginate($this->totalPage);
        return $mikrotiks;
    }

    
    public function procuraMikrotik(Request $request)
    {
        $mikrotiks = User::where('descricao', 'LIKE', '%'.$request->nomepesquisa.'%')->paginate($this->totalPage);
        $mikrotik = null;
        return view ('mikrotik.exibemikrotik', compact('mikrotiks', 'mikrotik'));
    }

    public function editaMikrotik(Request $request, $id)
    {
        DB::beginTransaction();
                $request->validate([
                'endereco'      => 'required',
                'usuario'       => 'required',
                'senha'         => 'required',
                'descricao'     => 'required',
		  ]);
        $mikrotik = Mikrotik::find($id);
            $mikrotik->endereco      =  $request->endereco;
            $mikrotik->usuario       =  $request->usuario;
            $mikrotik->senha         = $request->senha;
            $mikrotik->descricao     = $request->descricao;
                  
        $mikrotik->save();
        if($mikrotik){
            DB::commit(); 
                return redirect()
                    ->route('exibe.mikrotiks') 
                    ->with('success', 'Dados atualizados com sucesso!');
        }else{
             DB::rollback();
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao atusalizar os dados o mikrotik.');
        }
    }

    public function exibeMikrotik($id)
    {
        $mikrotiks = $this->listaMikrotiks();
        $mikrotik = Mikrotik::where('id', $id)->get()->first();
        return view ('mikrotik.exibemikrotik', compact('mikrotiks','mikrotik'));
    }




   

}
