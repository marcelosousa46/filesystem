@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Upload de arquivos</div>

                <div class="panel-body">
                    <nav>
                      <ul class="pager">
                        <li class="previous"><a href="{{url('/')}}"><span aria-hidden="true">&larr;</span>voltar</a></li>
                      </ul>
                    </nav>
                    @if (Auth::user()->status == 'L')
                        @if( isset($erro) )
                            <div class="alert alert-danger fade in">{{ $erro }}</div>  
                        @endif
                        @if( isset($sucesso) )
                            <div class="alert alert-success fade in">Upload de arquivo realizado com sucesso!</div>  
                        @endif
                        <h3><span class="label label-default"> Importar arquivo </span></h3>
                        {!! Form::open(array('url' => '/arquivo', 'enctype' => 'multipart/form-data', 'method' => 'post'))  !!}
                            <div class="form-group">
                                {!! Form::label('n1', 'Arquivo:') !!}
                                {!! Form::file('arquivo', $attributes = array()) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Enviar Arquivo', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}   
                    @else
                        <div class="alert alert-danger fade in">Sistema de arquivos bloqueado, favor solicitar desbloqueio.</div>  
                    @endif    
  
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
  <script>
    $(".alert").fadeTo(5000, 0.4).slideUp(700, function(){
      alert('ok');  
      $(".alert").alert('close');
    });
  </script>
@endpush
