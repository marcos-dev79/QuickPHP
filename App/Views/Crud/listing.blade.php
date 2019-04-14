@extends('Layout.admin_layout')

@section('content')
    <div class="listing_wrapper" ng-controller="getList" ng-init="init('/{{ $table  }}',0)">
        <div class="row">
            <div class="col-lg-12">
                
                @if(isset($tbldetails->display_name))
                <h2>{{ $tbldetails->display_name }}</h2>
                <a class="btn btn-success" href="/insert/{{ $table  }}"><i class="fa fa-plus"></i> {{ $lang->ADD }} {{ $tbldetails->display_name }}</a>
                @else
                <p><i class="glyphicon glyphicon-remove-circle"></i> {{ $lang->MALFORMED }}</p>                
                @endif
              
                <div class="sm-marg"></div>

                <div id="scrolltop"></div>

                @if(isset($tbldetails->filter))
                <div class="filter">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>Filtro</h4>
                            <form class="form-inline" action="/admsearch" method="post">
                                @foreach($tableObj['fields'] as $field)
                                    @if(in_array($field->Field, $tbldetails->filter))
                                        <?php
                                        $info = \Library\Utils\DataUtilities::deSerializeJson($field->Comment);
                                        $info->isfilter = true;
                                        $info->readonly = false;
                                        $info->required = false;
                                            if(isset($info->link_fk)){
                                                $link = \Library\DAO\Tables::getLinkObjects($info->link_fk);
                                                $link->details = \Library\DAO\Tables::getTableDetails($tableObj, $info->link_fk);
                                            }
                                        ?>
                                        <div class="form-group">
                                            @include('Components.'.$info->DOM)
                                        </div>
                                    @endif
                                @endforeach
                                <input type="hidden" id="table" name="table" value="{{ $table }}">
                                <button type="submit" class="btn btn-default">{{ $lang->FILTER }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="margin-bottom"></div><br>
                @endif



                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed" ng-cloak>
                        <tr>
                            <th class="text-center">{{ $lang->OPT }}</th>
                            <th ng-repeat="h in obj.headers" >@{{ h }}</th>
                        </tr>
                        <tr ng-show="obj.collection | isEmpty" ><td colspan="@{{ obj.colspan }}">{{ $lang->NORECORDS }}</td></tr>
                        <tr ng-repeat="item in obj.collection" >
                            <td class="min-width">
                                <p>
                                <a class="btn-sm btn-primary" ng-href="/editing/{{ $table }}/@{{ item.id }}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a class="btn-sm btn-danger pointer" ng-href="" ng-click="showModal(item.id)"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td class="max-width" ng-repeat="(key, col) in item" ng-if="obj.fieldsObj[key]" ng-switch="getTypeOf(col)">

                                <span ng-switch-when="string">
                                    <span ng-if="obj.fieldsObj[key].DOM == 'upload'"><img ng-src="/@{{ col }}" class="little-thumb" /></span>
                                    <span ng-if="obj.fieldsObj[key].DOM != 'upload' && key != 'totalvalue'" ng-bind-html="trustme(col)">@{{ col }}</span>
                                    <span ng-if="key == 'totalvalue'">@{{ col | currency }}</span>
                                </span>
                                <span ng-if="obj.fieldsObj[key].DOM == 'checkbox' && col ==1">Yes</span>
                                <span ng-if="obj.fieldsObj[key].DOM == 'checkbox' && col ==0">No</span>
                                <span ng-switch-when="number" ng-if="obj.fieldsObj[key].DOM != 'checkbox'">@{{ col }}</span>
                                <span ng-switch-when="object">
                                    <span ng-repeat="coln in col">@{{ coln.id }} - @{{ coln.display_field }}<br/></span>
                                </span>
                                <span ng-switch-default>@{{ col }}</span>
                            </td>
                        </tr>
                    </table>
                    <div>
                        <!-- Pagination -->
                        <nav ng-show="obj.links.total > obj.links.per_page" ng-cloak>
                            <ul class="pagination">
                                <li>
                                    <a href="" ng-click="init(obj.links.prev_page_url)" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li ng-repeat="a in range(obj.links.last_page) track by $index"><a href="" ng-click="init('/{{ $table  }}?page='+($index+1), 0)">@{{ $index + 1 }}</a></li>
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
        </div>

        <div class="sm-marg"></div>

        <div class="alert alert-danger alert-dismissible hidden" id="alertd" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ $lang->ERROR }}!</strong> {{ $lang->UNKERR }}.
        </div>

        <div class="alert alert-success alert-dismissible hidden" id="alerts" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ $lang->SUCCESS }}!</strong> {{ $lang->RECDEL }}.
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{ $lang->CONFIRM }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ $lang->ARSURE }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ $lang->CNCL }}</button>
                        <button type="button" id="exclui-btn" ng-click="deleteobj('{{ $table }}')" class="btn btn-primary">{{ $lang->DEL }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="/public/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.select2').select2({ });

            $( ".datepicker" ).datepicker({
                dateFormat: "dd/mm/yy",
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                nextText: 'Próximo',
                prevText: 'Anterior',
                changeMonth: true,
                changeYear: true,
                yearRange: "-110:+15",
                //minDate: '0'
            });

            tinymce.init({
                selector: '.text_advanced',
                plugins: "code"
            });

        });

    </script>
@endsection