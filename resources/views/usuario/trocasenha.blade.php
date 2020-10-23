@extends('adminlte::page')

@section('title', 'JUSTUS')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Alterar senha</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
    <form role="form" action="{{ route('grava.senha', Auth::user()->id) }}" method="POST">
        <div class="box-body">
            {!! csrf_field() !!}
            @method('PATCH')
                <div class="form-group has-feedback {{ $errors->has('senha') ? 'has-error' : '' }} col-sm-6">
                    <label for="password">Senha</label>
                    <input type="password" value="{{ old('senha') }}" name="senha" placeholder="Senha" class="form-control">
                        @if ($errors->has('senha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('senha') }}</strong>
                                </span>
                        @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('senha_confirmation') ? 'has-error' : '' }} col-sm-6">
                    <label for="password">Confirma Senha</label>
                    <input type="password" value="{{ old('senha_confirmation') }}" name="senha_confirmation" placeholder="Senha" class="form-control">
                        @if ($errors->has('senha_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('senha_confirmation') }}</strong>
                            </span>
                        @endif
                </div>
            
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-info">Atualizar</button>
                </div>
        </div> 
    </form>
</div>
@stop