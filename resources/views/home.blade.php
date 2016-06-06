@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Arquivos disponível para usuário: {{ $usuario->name }}</div>

                <div class="panel-body">
                    @if( isset($erro) )
                        <div class="alert alert-danger fade in">{{ $erro }}</div>  
                    @else    
                        @if( isset($sucesso) )
                            <div class="alert alert-success fade in">Operação realizada com sucesso!</div>  
                        @endif
                        <table class="table table-bordered">
                            <tr class="active">
                                <th>Nome</th>
                                <th>Data de modifição</th>
                                <th>Tamanho</th>
                                <th>Ação</th>
                            </tr>
                            @for($i = 0; $i < count($lista); $i++)
                               <tr>
                                <td>{{ $lista[$i][0] }}</td>
                                <td>{{ $lista[$i][1] }}</td>
                                <td>{{ $lista[$i][2] }}</td>
                                <td>
                                    <a href="{{'/download/'.$usuario->id.'/'.$lista[$i][0]}}" class="glyphicon glyphicon-download-alt"></a>
                                    <a href="{{'/delete/'.$usuario->id.'/'.$lista[$i][0]}}" class="glyphicon glyphicon-remove" onclick="return confirm(\'Excluir arquivo?\')"></a>
                                </td>
                               </tr>
                            @endfor
                        </table>        
                        <div class="panel panel-default">
                            <div class="panel-heading">Legenda</div>
                            <div class="glyphicon glyphicon-download-alt">  Download dos arquivos de usuário</div></br>
                            <div class="glyphicon glyphicon-remove">  Apagar arquivos de usuário</div></br>
                        </div>      

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
