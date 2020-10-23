@extends('adminlte::page')

@section('title', 'JUSTUS')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Atualizar Dados</h3>

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
                
                
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a class="btn btn-danger" href="{{ route('exibe.usuarios')}}">Cancelar</a>

                </div>
            </div>
              
              
        </form>
    </div>
 
           
@stop