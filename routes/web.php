<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

$this->group(['middleware' => ['auth']], function(){

/*Usuário*/
    $this->get('alterar-dados/{id}', 'UsuarioController@alterarDados')->name('alterar.dados');
    $this->get('alterar-senha', 'UsuarioController@alterarSenha')->name('alterar.senha');
    $this->PATCH('grava-senha/{id}', 'UsuarioController@gravaSenha')->name('grava.senha');
    $this->get('usuario', 'UsuarioController@exibeUsuarios')->name('exibe.usuarios');
    $this->post('usuario', 'UsuarioController@cadastraUsuario')->name('cadastra.usuario');
    $this->post('procura-usuario', 'UsuarioController@procuraUsuario')->name('procura.usuario');
    $this->DELETE('apagar-usuario/{id}', 'UsuarioController@apagarUsuario')->name('apagar.usuario');
    $this->PATCH('edita-usuario/{id}', 'UsuarioController@editaUsuario' )->name('edita.usuario');
    $this->get('exibe-usuario/{id}', 'UsuarioController@exibeUsuario')->name('exibe.usuario');


 /*Mikrotik*/   
 	$this->get('mikrotik', 'MikrotikController@exibeMikrotiks')->name('exibe.mikrotiks');
    $this->post('mikrotik', 'MikrotikController@cadastraMikrotik')->name('cadastra.mikrotik');
    $this->post('procura-mikrotik', 'MikrotikController@procuraMikrotik')->name('procura.mikrotik');
    $this->DELETE('apagar-mikrotik/{id}', 'MikrotikController@apagarMikrotik')->name('apagar.mikrotik');
    $this->PATCH('edita-mikrotik/{id}', 'MikrotikController@editaMikrotik' )->name('edita.mikrotik');
    $this->get('exibe-mikrotik/{id}', 'MikrotikController@exibeMikrotik')->name('exibe.mikrotik');

/*
RouterBoard 
Mikrotik Ações
*/
    /*Teste de Conexao*/
    $this->get('routerboard-teste', 'RouterBoardController@index')->name('routerboard.testeConexao');
    $this->post('routerboard-teste', 'RouterBoardController@testeConexao')->name('routerboard.testeConexao.resultado');

    /*CRUD - USUARIO MIKROTIK*/
    $this->get('routerboard-cadastrodeusuarios', 'RouterBoardController@routerBoardCadastroDeUsuarios')->name('routerboard.cadastrodeusuarios');
    $this->post('routerboard-cadastrodeusuarios-gravar', 'RouterBoardController@cadastrausuariosmikrotik')->name('routerboard.cadastrodeusuarios.gravar');
    $this->PATCH('routerboard-cadastrodeusuarios-alterar/{id}', 'RouterBoardController@atualizaUsuariosMikrotik' )->name('routerboard.cadastrodeusuarios.alterar');
    $this->get('routerboard-cadastrodeusuarios-exibe/{id}', 'RouterBoardController@exibeUsuariosMikrotik')->name('routerboard.cadastrodeusuarios.exibe');
    $this->DELETE('routerboard-cadastrodeusuarios-exclui/{id}', 'RouterBoardController@excluirCadastroClientesMikrotik')->name('routerboard.cadastrodeusuarios.exclui');
    $this->post('routerboard-cadastrodeusuarios-procura-usuario', 'RouterBoardController@procuraNomeUsuariosMikrotik')->name('routerboard.cadastrodeusuarios.procura.usuario');


    /*CRUD - BILHETES*/
    $this->get('routerboard-cadastrodebilhetes', 'RouterBoardController@routerBoardCadastroDeBilhetes')->name('routerboard.cadastrodebilhetes');
    $this->post('routerboard-cadastrodebilhetes-gerar', 'RouterBoardController@cadastrabilhetesmikrotik')->name('routerboard.cadastrodebilhetes.gerar');
    //$this->PATCH('routerboard-cadastrodebilhetes-habilitar/{id}', 'RouterBoardController@habilitarUsuariosMikrotik' )->name('routerboard.cadastrodebilhetes.habilitar');
    $this->get('routerboard-cadastrodebilhetes-habilitar/{id}', 'RouterBoardController@habilitarUsuariosMikrotik')->name('routerboard.cadastrodebilhetes.habilitar');
    $this->DELETE('routerboard-cadastrodebilhetes-exclui/{id}', 'RouterBoardController@excluirCadastroClientesMikrotik')->name('routerboard.cadastrodebilhetes.exclui');
    $this->post('routerboard-cadastrodebilhetes-procura-bilhete', 'RouterBoardController@procuraBilheteMikrotik')->name('routerboard.cadastrodebilhetes.procura.bilhete');
    $this->post('routerboard.cadastrodebilhetes.imprimirgerados', 'RouterBoardController@imprimeBilheteMikrotik')->name('routerboard.cadastrodebilhetes.imprimirgerados');
    

});


Auth::routes();