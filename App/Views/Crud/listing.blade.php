@extends('Layout.admin_layout')

@section('content')
    <div class="listing_wrapper" ng-controller="getList" ng-init="init('/{{ $table  }}')">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $tbldetails->display_name }}</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed" ng-cloak>
                        <tr>
                            <th class="text-center">Opções</th>
                            <th ng-repeat="h in obj.headers" >@{{ h }}</th>
                        </tr>
                        <tr ng-show="obj.collection | isEmpty" ><td colspan="@{{ obj.colspan }}">Não há registros.</td></tr>
                        <tr ng-repeat="item in obj.collection" >
                            <td class="text-center min-width">
                                <a class="btn-sm btn-primary" ng-href="/editing/{{ $table }}/@{{ item.id }}"><i class="glyphicon glyphicon-edit"></i></a>
                                &nbsp;
                                <a class="btn-sm btn-danger" href="" ng-click="showModal(item.id)"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td ng-repeat="(key, col) in item" ng-switch="getTypeOf(col)">
                                <span ng-switch-when="string">
                                    @{{ (obj.fieldsObj[key].DOM == 'upload') ? '' : col }}
                                    <span ng-if="obj.fieldsObj[key].DOM == 'upload'"><img src="/@{{ col }}" class="little-thumb" /></span>
                                </span>
                                <span ng-switch-when="number">@{{ col }}</span>
                                <span ng-switch-when="object">
                                    <span ng-repeat="coln in col">@{{ coln.id }} - @{{ coln.display_field }}<br/></span>
                                </span>
                                <span ng-switch-default>@{{ col }}</span>
                            </td>
                        </tr>
                    </table>
                    <div>
                        <nav ng-show="obj.links.total > obj.links.per_page" ng-cloak>
                            <ul class="pagination">
                                <li>
                                    <a href="" ng-click="init(obj.links.prev_page_url)" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li ng-repeat="a in range(obj.links.last_page) track by $index"><a href="" ng-click="init('/{{ $table  }}?page='+($index+1))">@{{ $index + 1 }}</a></li>
                                <li>
                                    <a href="" ng-click="init(obj.links.next_page_url)" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <a class="btn btn-success" href="/insert/{{ $table  }}"><i class="fa fa-plus"></i> Adicionar {{ $tbldetails->display_name }}</a>
            </div>
        </div>

        <div class="sm-marg"></div>

        <div class="alert alert-danger alert-dismissible hidden" id="alertd" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Sucesso!</strong> Erro desconhecido. Tente novamente.
        </div>

        <div class="alert alert-success alert-dismissible hidden" id="alerts" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Sucesso!</strong> Deletado com sucesso.
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Confirmar Exclusão</h4>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir este registro ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="exclui-btn" ng-click="deleteobj('{{ $table }}')" class="btn btn-primary">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection