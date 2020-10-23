@extends('adminlte::page')

@section('title', 'WIFI2.0')

@section('content_header')
    <h1></h1>
@stop

@section('content')
   
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Teste de Conexão</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form role="form" action="{{route('routerboard.testeConexao.resultado')}}" method="POST">
            {!! csrf_field() !!}
            <div class="box-body">
                @include('includes.alerts')
                <div class="form-group has-feedback {{ $errors->has('endereco') ? 'has-error' : '' }} col-sm-6">
                    <label>Clique para testar a conecão com o Mikrotik.</label>
                   
                </div>
                  
                <div class="form-group has-feedback col-sm-12">
                    <button type="submit" class="btn btn-info">Testar</button>
                </div>
            </div>
              
              
        </form>
        
      </div>

           
@stop