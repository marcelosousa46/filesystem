@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if (!Auth::guest())
                    <div class="panel-heading">Bem vindo, {{ Auth::user()->name }}</div>
                    @if (Auth::user()->status === 'L')
                        <div class="panel-body">
                            Sistema de arquivos CopyMax.
                        </div>
                    @else
                        <div class="panel-body">
                            Sistema de arquivos bloqueado, favor solicitar desbloqueio.
                        </div>
                    @endif    
                @else
                    <div class="panel-heading">Bem vindo!</div>
                @endif    
            </div>
        </div>
    </div>
</div>
@endsection
