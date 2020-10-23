@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))


@section('title', 'WIFI - ALBERT SABIN')

@section('content_header')
    <h1>HOSPITAL ALBERT SABIN</h1>
@stop
@section('body')

    
    <div class="box box-success col-sm-12">
        <div class="box-header with-border">
          <h3 class="box-title">Cadastro de Usuário</h3>

        </div>
        <form role="form" action="#" method="POST">
            {!! csrf_field() !!}
            <div class="box-body">
                @include('includes.alerts')
                              
                <div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-12" >
                    <label>Nome:</label>
                    <input type="text" value="{{ old('nome') }}" name="nome" placeholder="Nome" class="form-control">
                    @if ($errors->has('nome'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }} col-sm-6">
                    <label>CPF:</label>
                    <input type="text" value="{{ old('cpf') }}" name="cpf" placeholder="CPF" class="form-control">
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('salario') ? 'has-error' : '' }} col-sm-6" >
                    <label>Salário:</label>
                    <input type="text" value="{{ old('salario') }}" name="salario" placeholder="Salário" class="form-control">
                    @if ($errors->has('salario'))
                        <span class="help-block">
                            <strong>{{ $errors->first('salario') }}</strong>
                        </span>
                    @endif
                </div>

                
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Cadastro</button>
                </div>
            </div>
              
              
        </form>
        
     </div>

        
    @stop
