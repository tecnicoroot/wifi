@extends('adminlte::page')

@section('title', 'WIFI2.0')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    @if(!$usuario)
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Cadastro de Usuário</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form role="form" action="{{route('cadastra.usuario')}}" method="POST">
            {!! csrf_field() !!}
            <div class="box-body">
                @include('includes.alerts')
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }} col-sm-6">
                    <label>Nome:</label>
                    <input type="text" value="{{ old('name') }}" name="name" placeholder="Nome" class="form-control">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                  
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }} col-sm-6">
                    <label>Email:</label>
                    <input type="email" value="{{ old('email') }}" name="email" placeholder="E-mail" class="form-control">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('senha') ? 'has-error' : '' }} col-sm-3">
                    <label for="password">Senha</label>
                    <input type="password" value="{{ old('senha') }}" name="senha" placeholder="Senha" class="form-control">
                    @if ($errors->has('senha'))
                        <span class="help-block">
                            <strong>{{ $errors->first('senha') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('senha_confirmation') ? 'has-error' : '' }} col-sm-3">
                    <label for="password">Confirma Senha</label>
                    <input type="password" value="{{ old('senha_confirmation') }}" name="senha_confirmation" placeholder="Senha" class="form-control">
                    @if ($errors->has('senha_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('senha_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('perfil') ? 'has-error' : '' }} col-sm-3">
                    <label>Perfil</label>
                    <select class="form-control " name='perfil' style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value='-1'>Selecionar...</option>
                        <option value='1'>Administrador</option>
                        <option value='2'>Funcionário</option>
                      
                    </select>
                </div>
                <div class="form-group has-feedback {{ $errors->has('status') ? 'has-error' : '' }} col-sm-3">
                    <label>Status</label>
                    <select class="form-control"  name='status' style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value='-1'>Selecionar...</option>
                        <option value='A'>Ativado</option>
                        <option value='D'>Desativado</option>
                      
                    </select>
                </div>
                
                
                <div class="form-group has-feedback col-sm-12">
                    <button type="submit" class="btn btn-info">Cadastro</button>
                </div>
            </div>
              
              
        </form>
        
      </div>
      @else
        <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Atualizar Usuário</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form role="form" action="{{route('edita.usuario', $usuario->id)}}" method="POST" name="2">
            {!! csrf_field() !!}
            @method('PATCH')
            <div class="box-body">
                @include('includes.alerts')
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }} col-sm-6">
                    <label>Nome:</label>
                    <input type="text" value="{{ old('name') ? old('name') : $usuario->name }}" name="name" placeholder="Nome" class="form-control">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                  
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }} col-sm-6">
                    <label>Email:</label>
                    <input type="email" value="{{ old('email') ? old('email') : $usuario->email }}" name="email" placeholder="E-mail" class="form-control">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-group has-feedback {{ $errors->has('perfil') ? 'has-error' : '' }} col-sm-3">
                    <label>Perfil</label>
                    <select class="form-control " name='perfil' style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option {{ $usuario->idperfil == -1 ? 'selected' : '' }} value='-1'>Selecionar...</option>
                        <option {{ $usuario->idperfil == 1 ? 'selected' : '' }}  value='1'>Administrador</option>
                        <option {{ $usuario->idperfil == 2 ? 'selected' : '' }}  value='2'>Empresa</option>
                      
                    </select>
                </div>
                <div class="form-group has-feedback {{ $errors->has('status') ? 'has-error' : '' }} col-sm-3">
                    <label>Status</label>
                    <select class="form-control"  name='status' style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option {{ $usuario->tpstatus == -1 ? 'selected' : '' }} value='-1'>Selecionar...</option>
                        <option {{ $usuario->tpstatus == "A" ? 'selected' : '' }} value='A'>Ativado</option>
                        <option {{ $usuario->tpstatus == "D" ? 'selected' : '' }} value='D'>Desativado</option>
                      
                    </select>
                </div>
                
                <div class="form-group has-feedback col-sm-12">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a class="btn btn-danger" href="{{ route('exibe.usuarios')}}">Cancelar</a>

                </div>
            </div>
              
              
        </form>
      </div>
      @endif    
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Usuários</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        
            <div class="box-body">
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div id="example1_filter" class="dataTables_filter">
                                    <form role="form" action="{{route('procura.usuario')}}" method="POST">
                                    {!! csrf_field() !!}
                                        <label>Pesquisar:
                                            <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1" name="nomepesquisa" ></label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 50px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 361px;">Nome</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 323px;">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 257px;">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 191px;">Perfil</th>
                                                <th style="width: 191px;">Opções</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($usuarios as $usuario)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $usuario->id }}</td>
                                                <td>{{ $usuario->name}}</td>
                                                <td>{{ $usuario->email}}</td>
                                                <td>{{ $usuario->status($usuario->tpstatus)}}</td>
                                                <td>{{ $usuario->perfil($usuario->idperfil)}}</td>

                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning{{ $usuario->id }}" >
                                                            Deletar
                                                    </button>
                                                    <div class="modal modal-default fade" id="modal-warning{{ $usuario->id }}" style="display: none;">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Remover Usuário</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Tem certeza que gostaria de removero o usuário: {{$usuario->name}}</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancela</button>
                                                            <form action="{{ route('apagar.usuario', $usuario->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit">Sim</button>
                                                                
                                                            </form>
                                                          </div>
                                                        </div>
                                                            
                                                      </div>
                                                      <!-- /.modal-dialog -->
                                                    </div>
                                                   
                                                    <a class="btn btn-info" href="{{ route('exibe.usuario', $usuario->id) }}">Editar</a>
                                                    
                                                     
                                                </td>
                                                                                               
                                            <tr>
                                            @empty
                                            @endforelse
                                        
                                                        
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">#</th>
                                                <th rowspan="1" colspan="1">Nome</th>
                                                <th rowspan="1" colspan="1">Email</th>
                                                <th rowspan="1" colspan="1">Status</th>
                                                <th rowspan="1" colspan="1">Perfil</th>
                                                <th rowspan="1" colspan="1">Opções</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
          
          <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Exibidos {{ $usuarios->count() }} de {{$usuarios->total()}}</div>
                </div>
                <div class="col-sm-7"
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        {{ $usuarios->links()}}
                    </div>
                </div>
        </div>
        </div>
           
@stop