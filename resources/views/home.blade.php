@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Seja bem vindo!</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        
    </div>
              
              
        
        
     
@stop

@section('content')
	@include('includes.alerts')
    <p></p>
@stop