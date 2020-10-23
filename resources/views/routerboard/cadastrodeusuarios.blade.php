@extends('adminlte::page')

@section('title', 'WIFI2.0')

@section('content_header')
    <h1></h1>
@stop
<?php

    

    //dd($resultado);
?>
@section('content')
   @if(!$usuario)
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Cadastro de Usuários</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form role="form" action="{{route('routerboard.cadastrodeusuarios.gravar')}}" method="POST">
            {!! csrf_field() !!}
            <div class="box-body">
                 @include('includes.alerts')
                <div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-3">
                    <label>Nome:</label>
                    <input type="text" value="{{ old('nome') }}" name="nome" placeholder="Nome" class="form-control">
                    @if ($errors->has('nome'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>
                  
                

                <div class="form-group has-feedback {{ $errors->has('mac') ? 'has-error' : '' }} col-sm-3">
                    <label>Endereço MAC:</label>
                    <input type="text" value="{{ old('mac') }}" name="mac" id='mac' placeholder="MAC" class="form-control" data-mask="AA:AA:AA:AA:AA:AA" onblur="alterar();">
                    @if ($errors->has('mac'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mac') }}</strong>
                        </span>
                    @endif
                </div>

                <script type="text/javascript">
                   
                       function alterar(){
                            if (document.getElementById('mac') !== null){
                                var cible = document.getElementById('mac')
                                    cible.value = cible.value.toUpperCase();
                            }
                        }
                      
              
                </script>

                <div class="form-group has-feedback {{ $errors->has('perfil') ? 'has-error' : '' }} col-sm-3">
                    <label>Perfil</label>
                    <select class="form-control " name='perfil' style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value='-1'>Selecionar...</option>
                        <option value='Cliente'>Cliente</option>
                        <option value='Diretoria'>Diretoria</option>
                        <option value='Funcionarios'>Funcionários</option>
                        
                        <option value='Medicos'>Médicos</option>
                        <option value='Terceirizados'>Terceirizados</option>
                        <option value='TI'>Tecnologia da Informação</option>
                        <option value='Temp'>Temporário</option>
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
        <form role="form" action="{{route('routerboard.cadastrodeusuarios.alterar', $usuario[0]['.id']) }}" method="POST" name="2">
            {!! csrf_field() !!}
            @method('PATCH')
            <div class="box-body">
                @include('includes.alerts')
                <div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-3">
                    <label>Nome:</label>
                    <input type="text" value="{{ old('nome') ? old('nome') : $usuario[0]['comment'] }}" name="nome" placeholder="Nome" class="form-control">
                    @if ($errors->has('nome'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>
                @if (isset($usuario[0]['mac-address']))
                    <div class="form-group has-feedback {{ $errors->has('mac') ? 'has-error' : '' }} col-sm-3">
                        <label>Email:</label>
                        <input type="text" value="{{ old('mac') ? old('mac') : $usuario[0]['mac-address'] }}" name="mac" placeholder="MAC" class="form-control" data-mask="AA:AA:AA:AA:AA:AA" onblur="alterar();">
                        @if ($errors->has('mac'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mac') }}</strong>
                            </span>
                        @endif
                    </div>
                @endif    
                
                <div class="form-group has-feedback {{ $errors->has('perfil') ? 'has-error' : '' }} col-sm-3">
                    <label>Perfil</label>
                    <select class="form-control " name='perfil' style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option {{ $usuario[0]['profile']== -1 ? 'selected' : '' }} value='-1'>Selecionar...</option>
                        <option {{ $usuario[0]['profile'] == 'Cliente' ? 'selected' : '' }}  value='Cliente'>Cliente</option>
                        <option {{ $usuario[0]['profile'] == 'Diretoria' ? 'selected' : '' }}  value='Diretoria'>Diretoria</option>
                        <option {{ $usuario[0]['profile'] == 'Funcionarios' ? 'selected' : '' }}  value='Funcionarios'>Funcionários</option>
                        
                        <option {{ $usuario[0]['profile'] == 'Medicos' ? 'selected' : '' }}  value='Medicos'>Médicos</option>
                        <option {{ $usuario[0]['profile'] == 'Terceirizados' ? 'selected' : '' }}  value='Terceirizados'>Terceirizados</option>
                        <option {{ $usuario[0]['profile'] == 'TI' ? 'selected' : '' }}  value='TI'>Tecnologia da Informação</option>
                        <option {{ $usuario[0]['profile'] == 'Temp' ? 'selected' : '' }}  value='Temp'>Temporário</option>
                    </select>
                </div>
             
                
                <div class="form-group has-feedback col-sm-12">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a class="btn btn-danger" href="{{ route('routerboard.cadastrodeusuarios')}}">Cancelar</a>

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
                                    <form role="form" action="{{route('routerboard.cadastrodeusuarios.procura.usuario')}}" method="POST">
                                    {!! csrf_field() !!}
                                        <label>Pesquisar:
                                            <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1" name="nomepesquisa" id="nomepesquisa"></label>
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
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 323px;">MAC</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 191px;">Perfil</th>
                                                <th style="width: 191px;">Opções</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($resultado as $usuario)
                                            
                                            <?php
                                            if(isset($usuario['.id'])){
                                                $usuario['.id'] = str_replace('*', '', $usuario['.id']);
                                            
                                            ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $usuario['.id'] }}</td>
                                                <td>{{ $usuario['comment']}}</td>
                                            <?php
                                                if(isset($usuario['mac-address'])){
                                            ?>
                                                    <td>{{ $usuario['mac-address']}}</td>
                                            <?php
                                                }else{
                                            ?>
                                                    <td></td>
                                            <?php        
                                                }
                                            ?>        
                                                <td>{{ $usuario['profile']}}</td>
                                                

                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning{{ $usuario['.id']  }}" >
                                                            Deletar
                                                    </button>
                                                    <div class="modal modal-default fade" id="modal-warning{{ $usuario['.id'] }}" style="display: none;">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Remover Usuário</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Tem certeza que gostaria de removero o usuário: {{$usuario['comment']}}</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancela</button>
                                                            <form action="{{ route('routerboard.cadastrodeusuarios.exclui', $usuario['.id']) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit">Sim</button>
                                                                
                                                            </form>
                                                          </div>
                                                        </div>
                                                            
                                                      </div>
                                                      <!-- /.modal-dialog -->
                                                    </div>
                                                   
                                                    <a class="btn btn-info" href="{{ route('routerboard.cadastrodeusuarios.exibe', $usuario['.id'] ) }}">Editar</a>
                                                    
                                                     
                                                </td>
                                                                                               
                                            </tr>
                                              <?php
                                                } else if(isset($usuario[0]['.id'])){
                                                                                                
                                                    $usuario[0]['.id'] = str_replace('*', '', $usuario[0]['.id']);
                                                ?>

                                                 <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $usuario[0]['.id'] }}</td>
                                                <td>{{ $usuario[0]['comment']}}</td>
                                                <td>{{ $usuario[0]['mac-address']}}</td>
                                                <td>{{ $usuario[0]['profile']}}</td>
                                                

                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning{{ $usuario[0]['.id']  }}" >
                                                            Deletar
                                                    </button>
                                                    <div class="modal modal-default fade" id="modal-warning{{ $usuario[0]['.id'] }}" style="display: none;">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Remover Usuário</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>Tem certeza que gostaria de removero o usuário: {{$usuario[0]['comment']}}</p>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cancela</button>
                                                            <form action="{{ route('routerboard.cadastrodeusuarios.exclui', $usuario[0]['.id']) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit">Sim</button>
                                                                
                                                            </form>
                                                          </div>
                                                        </div>
                                                            
                                                      </div>
                                                      <!-- /.modal-dialog -->
                                                    </div>
                                                   
                                                    <a class="btn btn-info" href="{{ route('routerboard.cadastrodeusuarios.exibe', $usuario[0]['.id'] ) }}">Editar</a>
                                                    
                                                     
                                                </td>
                                                                                               
                                            <tr>
                                                <?php
                                                    }
                                                ?>
                                            @empty
                                            @endforelse

                                                        
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
          
          <div class="row">
                <?php
                if($contar > 10){
                ?>
                <div class="col-sm-12">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                              <li class="page-item <?= $pg == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="?pg=<?= $pg-1 ?>" tabindex="-1">Anterior</a>
                              </li>
                              
                              <?php
                              if($atual < $contar-4){
                                printf('<li class="page-item"><a  class="page-link" href="?pg=%s"> %s </a></li>', $atual, $atual) ;
                                printf('<li class="page-item"><a  class="page-link" href="?pg=%s"> %s </a></li>', $atual+1, $atual+1);
                                printf('<li class="page-item"><a  class="page-link" href="?pg=%s"> %s </a></li>', $atual+2, $atual+2);
                              }else{
                                printf('<li class="page-item"><a class="page-link" href="?pg=%s"> %s </a></li>', $contar-5, $contar-5);
                                printf('<li class="page-item"><a  class="page-link" href="?pg=%s"> %s </a></li>', $contar-4, $contar-4);
                                printf('<li class="page-item"><a  class="page-link" href="?pg=%s"> %s </a></li>', $contar-3, $contar-3); 
                              }
                              ?>
                              <li class="page-item">
                                  <a id="buscapagina" class="page-link" href="" 
                                    style="padding: 0;
                                        margin: 0;"
                                  >
                                    <form role="form" action="" id="formbusca" method="GET">
                                        <input type="text" name="pg"  id="campobusca" class="form-control" 
                                            style="padding: 0;
                                                margin: 0;
                                                width: 37px;
                                                text-align: center;
                                                height: 33px;"
                                        >
                                    </form>   
                                  </a>
                              </li>
                              <?php
                              printf('<li class="page-item"><a  class="page-link" href="?pg=%s"> %s </a></li>', $contar-2, $contar-2);
                              printf('<li class="page-item"><a  class="page-link" href="?pg=%s"> %s </a></li>', $contar-1, $contar-1);
                              printf('<li class="page-item"><a  class="page-link" href="?pg=%s"> %s </a></li>', $contar, $contar);
                              
                            /*for($i = 1; $i <= $contar; $i++){
                                  if($atual == $i){
                                      printf('<li class="page-item  active"><a class="page-link" href="#">%s</a></li>', $i);
                                  }else{
                                      printf('<li class="page-item"><a class="page-link" href="?pg=%s"> %s </a></li>', $i,$i);
                                  }
                            }*/
                            ?>
                              <li class="page-item <?= $pg == $contar ? 'disabled' : '' ?>" >
                                <a class="page-link"  href="?pg=<?= $pg+1 ?>">Próximo</a>
                              </li>
                            </ul>
                          </nav>
                        
                       
                    </div>
                </div>
            <?php } ?>
      </div>
        
    </div>
           
@stop

@section('js')
<script>
    $(document).ready(function(){

        // Impede o click na tag <a>
        $("#buscapagina").click(function( event ) {
            event.preventDefault();
        });
        /*Aceita apenas letras maiúsculas e minusculas*/
        $('#nomepesquisa').keyup(function() {
            $(this).val(this.value.replace(/[^a-zA-Z]+/g, ''));
          });
        
    });
</script>    
@stop