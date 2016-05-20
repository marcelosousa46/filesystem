@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Relação dos usuários</div>

                <div class="panel-body">
                    @if( isset($erro) )
                        <div class="alert alert-danger fade in">{{ $erro }}</div>  
                    @else    
                        @if( isset($sucesso) )
                            <div class="alert alert-success fade in">Operação realizada com sucesso!</div>  
                        @endif
                        <table class="table table-bordered">
                            <tr class="active">
                                <th>Usuários</th>
                                <th>Ação</th>
                            </tr>
                            @for($i = 0; $i < count($lista); $i++)
                               <tr>
                                <td>{{ $lista[$i]->name }}</td>
                                <td>
                                    <a href="{{'/desbloqueio/'.$lista[$i]->id}}" class="glyphicon glyphicon-ok"></a>
                                    <a href="{{'/bloqueio/'.$lista[$i]->id}}" class="glyphicon glyphicon-ban-circle" onclick="return confirm(\'Excluir arquivo?\')"></a>
                                    <a href="{{'/usuario/'.$lista[$i]->id}}" class="glyphicon glyphicon-download-alt"></a>
                                    @if ( $lista[$i]->status === 'L' )
                                        <i class="fa fa-circle text-success"></i>
                                    @else
                                        <i class="fa fa-circle text-danger"></i>
                                    @endif    
                                </td>
                               </tr>
                            @endfor
                        </table>                    
                        <div class="panel panel-default">
                            <div class="panel-heading">Legenda</div>
                            <div class="glyphicon glyphicon-ok">  Liberar usuário</div></br>
                            <div class="glyphicon glyphicon-ban-circle">  Bloquear usuário</div></br>
                            <div class="glyphicon glyphicon-download-alt">  Download dos arquivos de usuário</div></br>
                            <div class="fa fa-circle text-success">  Usuário desbloqueado</div></br>
                            <div class="fa fa-circle text-danger">  Usuário bloqueado</div></br>
                        </div>      

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
