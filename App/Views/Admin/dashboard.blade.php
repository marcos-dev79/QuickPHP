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
                                <i class="fa fa-angle-right"></i> Edit {{ $tbl->TABLE_COMMENT->display_name }}
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
                    <i class="fa fa-bar-chart-o fa-fw"></i> System's activities
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
                    <i class="fa fa-bell fa-fw"></i> Notifications
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        @if(isset($logs) && count($logs)>0)
                            @foreach($logs as $l)
                            <a href="/editing/{{ $l->table }}/{{ $l->recordid }}" class="list-group-item">
                                <i class="fa fa-comment fa-fw"></i> {{ $l->log }}
                                            <span class="pull-right text-muted small">
                                            <a href="/editing/log/{{ $l->id }}"><small><i class="fa fa-arrow-right"></i> At
                                                    <em>{{ \Library\Dates\Dates::TimedDateBR($l->updated_at) }}</em></small>
                                                </a>
                                            </span>
                            </a>
                            @endforeach
                        @else
                            <span>No records entered on the application.</span>
                        @endif
                    </div>
                    <!-- /.list-group -->
                    <a href="/listing/log" class="btn btn-default btn-block">See All Logs</a>
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
    <script>

    $(function() {

        Morris.Bar({
            element: 'morris-area-chart',
            data: [
            @foreach($topTableData as $dt)
            {
                y: '{{ $dt->new_date }}',
                a: '{{ $dt->data }}'
            },
            @endforeach
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Quantity'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });
    });
    </script>
@endsection