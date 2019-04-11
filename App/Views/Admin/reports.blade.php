@extends('Layout.admin_layout')

@section('content')
    <div class="sm-marg"></div>
    <div class="container-fluid">

        <form method="post" action="/processreport" target="_blank" >

            <div class="row">
                <div class="col-lg-12 text-left">
                    <h2>Reports</h2>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h3>Select a Table</h3>
                        <select id="tableslc" required name="tableslc" class="form-control select2">
                            <option>Escolha uma</option>
                        @foreach($tableObj as $tbl)
                            <option value="{{ $tbl['tblname']->TABLE_NAME }}">{{ $tbl['tblinfo']->display_name }}</option>
                        @endforeach
                        </select>

                    </div>

                    <div class="col-md-6">
                        <div id="displayfields">
                            <h3>Select the Fields of the table</h3>
                            <select id="fieldsslc" required name="fieldsslc[]" class="form-control select3" multiple>
                                
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-lg-12 text-left">
                    <h3>Filters</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Start Date</label>
                        <div class="col-sm-9">
                            <input type="text" required name="startdate" class="form-control datepicker" >
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">End Date</label>
                        <div class="col-sm-9">
                            <input type="text" required name="enddate" class="form-control datepicker" >
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="submit" class="btn btn-success" value="Export" />
                </div>
            </div>

        </form>

    </div>
@endsection

@section('js')

    <script type="text/javascript">
        $(function() {

            var $eventSelect = $('.select2');
            $eventSelect.select2();

            
            var $fieldSelect = $('.select3');
            $fieldSelect.select2();

            $eventSelect.on("select2:select", function (e) {
                $fieldSelect.val(null).trigger('change');
                $fieldSelect.empty().trigger('change');
                var text = $('#tableslc').val();
                
                var request = $.ajax({
                                url: "/getfields",
                                method: "POST",
                                data: { table : text },
                                dataType: "json"
                                });
                                
                request.done(function( msg ) {
                    $fieldSelect.select2({ data: msg });
                });

            });

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


        });
    </script>
@endsection