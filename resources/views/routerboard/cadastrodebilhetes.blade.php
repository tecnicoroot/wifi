@extends('adminlte::page')

@section('title', 'WIFI2.0')

@section('content_header')
    <h1></h1>
@stop

@section('content')
   <div class="row">
       <div class="col-sm-6">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Gerar bilhetes</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <form role="form" action="{{route('routerboard.cadastrodebilhetes.gerar')}}" method="POST">
                    {!! csrf_field() !!}
                    <div class="box-body">
                         @include('includes.alerts')
                                          
                        <div class="form-group has-feedback {{ $errors->has('quantidade') ? 'has-error' : '' }} ">
                             <label>Selecione a quantidade a ser gerada.</label>
                            <select class="form-control " name='quantidade'  tabindex="-1" aria-hidden="true">
                                <option value='-1'>Selecionar...</option>
                                <option value='20'>20</option>
                                <option value='40'>40</option>
                                <option value='60'>60</option>
                                <option value='80'>80</option>
                                <option value='100'>100</option>
                                
                            </select>
                            @if ($errors->has('quantidade'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantidade') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                        
                        
                        <div class="form-group has-feedback col-sm-12">
                            <button type="submit" class="btn btn-info">Gerar Bilhetes de Acesso</button>
                        </div>
                    </div>
                </form>
                
            </div>
       </div>
   <div class="col-sm-6">
        <div class="box box-success ">
            <div class="box-header with-border">
              <h3 class="box-title">Impressão de bilhetes</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <form role="form" action="{{route('routerboard.cadastrodebilhetes.imprimirgerados')}}" method="POST">
                {!! csrf_field() !!}
                <div class="box-body">
                     @include('includes.alerts')
                                      
                    <div class="form-group has-feedback {{ $errors->has('perfil') ? 'has-error' : '' }} ">
                        
                        <label>Imprimir os todos bilhetes gerados e que não foram impressos.</label></br>
                    </div>
                    <div class="form-group has-feedback col-sm-12">
                        <button type="submit" class="btn btn-info">Imprimir Bilhetes</button>
                    </div>
                </div>
            </form>
           </div> 
   </div>
   </div>
    

    
   
      
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Bilhetes</h3>

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
                                    <form role="form" action="{{route('routerboard.cadastrodebilhetes.procura.bilhete')}}" method="POST">
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
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 361px;">Bilhete</th>
                                                
                                                <th style="width: 191px;">Opções</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($bilhetes as $bilhete)
                                            
                                            <?php
                                            if(isset($bilhete['.id'])){
                                                $bilhete['.id'] = str_replace('*', '', $bilhete['.id']);
                                            
                                            ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $bilhete['.id'] }}</td>
                                                <td>{{ $bilhete['name']}}</td>
                                                
                                                

                                                <td>
                                                    
                                                   
                                                    <a class="btn btn-info" href="{{ route('routerboard.cadastrodebilhetes.habilitar', $bilhete['.id'] ) }}">Habilitar</a>
                                                    
                                                     
                                                </td>
                                                                                               
                                            </tr>
                                              <?php
                                                } else if(isset($bilhete[0]['.id'])){
                                                                                                
                                                    $bilhete[0]['.id'] = str_replace('*', '', $bilhete[0]['.id']);
                                                ?>

                                                 <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $bilhete[0]['.id'] }}</td>
                                                <td>{{ $bilhete[0]['name']}}</td>
                                                
                                                

                                                <td>
                                                    
                                                   
                                                    <a class="btn btn-info" href="{{ route('routerboard.cadastrodebilhetes.habilitar', $bilhete[0]['.id'] ) }}">Habilitar</a>
                                                    
                                                     
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
                                                <th rowspan="1" colspan="1">#</th>
                                                <th rowspan="1" colspan="1">Bilhete</th>
                                                
                                                <th rowspan="1" colspan="1">Opções</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
          
          <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Exibidos  de </div>
                </div>
                <div class="col-sm-7"
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        
                    </div>
                </div>
        </div>
        </div>
           
@stop