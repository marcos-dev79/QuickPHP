@extends('Layout.admin_layout')

@section('content')
    <div class="sm-marg"></div>
    <!-- /.row -->
    <div class="row">
        @if(isset($tblobj) && count($tblobj)>0)
            @foreach($tblobj as $tbl)
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-check-circle fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $tbl->count }}</div>
                                <div>{{ $tbl->TABLE_COMMENT->display_name }}</div>
                            </div>
                        </div>
                    </div>
                    <a href="/listing/{{ $tbl->TABLE_NAME }}">
                        <div class="panel-footer">
                            <span class="pull-left">
                                <i class="fa fa-angle-right"></i> Editar {{ $tbl->TABLE_COMMENT->display_name }}
                            </span>
                            <br>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        @else
        <div class="col-lg-3 col-md-6">
            <i class="fa fa-database fa-3x"></i> When you have tables configured, their info will appear here.
        </div>
        @endif 

        
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Evolução das Vendas
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Filtro
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a>
                                </li>
                                <li><a href="#">Another action</a>
                                </li>
                                <li><a href="#">Something else here</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart"></div>
                </div>
                <!-- /.panel-body -->
            </div>


        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Painel de Notificações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i> Novo Comentário
                                        <span class="pull-right text-muted small"><em>4 minutos</em>
                                        </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-twitter fa-fw"></i> Novo cliente cadastrado
                                        <span class="pull-right text-muted small"><em>12 minutos</em>
                                        </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i> Pedido de Suporte
                                        <span class="pull-right text-muted small"><em>27 minutos</em>
                                        </span>
                        </a>
                        <a href="/vendas" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> Nova venda
                                        <span class="pull-right text-muted small"><em>43 minutos</em>
                                        </span>
                        </a>
                        <a href="/vendas" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> Nova venda
                                        <span class="pull-right text-muted small"><em>19:30</em>
                                        </span>
                        </a>
                        <a href="/vendas" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> Nova venda
                                        <span class="pull-right text-muted small"><em>18:30</em>
                                        </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-upload fa-fw"></i> Serviço atualizado
                                        <span class="pull-right text-muted small"><em>11:32</em>
                                        </span>
                        </a>


                    </div>
                    <!-- /.list-group -->
                    <a href="#" class="btn btn-default btn-block">Ver Todos os Alertas</a>
                </div>
                <!-- /.panel-body -->
            </div>

        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
@endsection

@section('js')
    <script src="/public/bower_components/morrisjs/morris.min.js"></script>
    <script src="/public/Js/morris-data.js"></script>
@endsection