@extends('adminlte::page')

@section('title', 'WIFI2.0')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    @if(!$mikrotik)
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Cadastro de Mikrotik</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form role="form" action="{{route('cadastra.mikrotik')}}" method="POST">
            {!! csrf_field() !!}
            <div class="box-body">
                @include('includes.alerts')
                <div class="form-group has-feedback {{ $errors->has('endereco') ? 'has-error' : '' }} col-sm-6">
                    <label>Endereço:</label>
                    <input type="text" value="{{ old('endereco') }}" name="endereco" placeholder="url" class="form-control">
                    @if ($errors->has('endereco'))
                        <span class="help-block">
                            <strong>{{ $errors->first('endereco') }}</strong>
                        </span>
                    @endif
                </div>
                  
                <div class="form-group has-feedback {{ $errors->has('usuario') ? 'has-error' : '' }} col-sm-6">
                    <label>Usuário:</label>
                    <input type="text" value="{{ old('usuario') }}" name="usuario" placeholder="Usuário" class="form-control">
                    @if ($errors->has('usuario'))
                        <span class="help-block">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('senha') ? 'has-error' : '' }} col-sm-3">
                    <label for="text">Senha</label>
                    <input type="text" value="{{ old('senha') }}" name="senha" placeholder="Senha" class="form-control">
                    @if ($errors->has('senha'))
                        <span class="help-block">
                            <strong>{{ $errors->first('senha') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('descricao') ? 'has-error' : '' }} col-sm-6">
                    <label>Descrição:</label>
                    <input type="text" value="{{ old('descricao') }}" name="descricao" placeholder="Descrição" class="form-control">
                    @if ($errors->has('descricao'))
                        <span class="help-block">
                            <strong>{{ $errors->first('descricao') }}</strong>
                        </span>
                    @endif
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
          <h3 class="box-title">Cadastro de Usuário</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form role="form" action="{{route('edita.mikrotik', $mikrotik->id)}}" method="POST" name="2">
            {!! csrf_field() !!}
            @method('PATCH')
            <div class="box-body">
                @include('includes.alerts')
                <div class="form-group has-feedback {{ $errors->has('endereco') ? 'has-error' : '' }} col-sm-6">
                    <label>Endereço:</label>
                    <input type="text" value="{{ old('endereco') ? old('endereco') : $mikrotik->endereco }}" name="endereco" placeholder="Endereço" class="form-control">
                    @if ($errors->has('endereco'))
                        <span class="help-block">
                            <strong>{{ $errors->first('endereco') }}</strong>
                        </span>
                    @endif
                </div>
                  
                <div class="form-group has-feedback {{ $errors->has('usuario') ? 'has-error' : '' }} col-sm-6">
                    <label>Usuário:</label>
                    <input type="text" value="{{ old('usuario') ? old('usuario') : $mikrotik->usuario }}" name="usuario" placeholder="Usuário" class="form-control">
                    @if ($errors->has('usuario'))usuario
                        <span class="help-block">
                            <strong>{{ $errors->first('usuario') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('senha') ? 'has-error' : '' }} col-sm-6">
                    <label>Senha:</label>
                    <input type="text" value="{{ old('senha') ? old('senha') : $mikrotik->senha }}" name="senha" placeholder="Senha" class="form-control">
                    @if ($errors->has('senha'))
                        <span class="help-block">
                            <strong>{{ $errors->first('senha') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('descricao') ? 'has-error' : '' }} col-sm-6">
                    <label>Descrição:</label>
                    <input type="text" value="{{ old('descricao') ? old('descricao') : $mikrotik->descricao }}" name="descricao" placeholder="Descrição" class="form-control">
                    @if ($errors->has('descricao'))
                        <span class="help-block">
                            <strong>{{ $errors->first('descricao') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-group has-feedback col-sm-12">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a class="btn btn-danger" href="{{ route('exibe.mikrotiks')}}">Cancelar</a>

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
                                    <form role="form" action="{{route('procura.mikrotik')}}" method="POST">
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
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 361px;">Endereço</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 323px;">Usuário</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 257px;">senha</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 191px;">Descrição</th>
                                                <th style="width: 191px;">Opções</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($mikrotiks as $mikrotik)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $mikrotik->id }}</td>
                                                <td>{{ $mikrotik->endereco}}</td>
                                                <td>{{ $mikrotik->usuario}}</td>
                                                <td>{{ $mikrotik->senha}}</td>
                                                <td>{{ $mikrotik->descricao}}</td>

                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning{{ $mikrotik->id }}" >
                                                            Deletar
                                                    </button>
                                                    <div class="modal modal-default fade" id="modal-warning{{ $mikrotik->id }}" style="display: none;">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Remover Mikrotik</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Tem certeza que gostaria de removero o Mikrotik: {{$mikrotik->descricao}}</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancela</button>
                                                            <form action="{{ route('apagar.mikrotik', $mikrotik->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit">Sim</button>
                                                                
                                                            </form>
                                                          </div>
                                                        </div>
                                                            
                                                      </div>
                                                      <!-- /.modal-dialog -->
                                                    </div>
                                                   
                                                    <a class="btn btn-info" href="{{ route('exibe.mikrotik', $mikrotik->id) }}">Editar</a>
                                                    
                                                     
                                                </td>
                                                                                               
                                            <tr>
                                            @empty
                                            @endforelse
                                        
                                                        
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">#</th>
                                                <th rowspan="1" colspan="1">Endereço</th>
                                                <th rowspan="1" colspan="1">Usuário</th>
                                                <th rowspan="1" colspan="1">Senha</th>
                                                <th rowspan="1" colspan="1">Descrição</th>
                                                <th rowspan="1" colspan="1">Opções</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
          
          <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Exibidos {{ $mikrotiks->count() }} de {{$mikrotiks->total()}}</div>
                </div>
                <div class="col-sm-7"
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        {{ $mikrotiks->links()}}
                    </div>
                </div>
        </div>
        </div>
           
@stop