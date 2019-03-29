<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>

    <link rel="stylesheet" type="text/css" href="/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/public/bower_components/jquery-ui/themes/flick/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/bower_components/metisMenu/dist/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="/public/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/Css/sb-admin-2.css">
    <link rel="stylesheet" type="text/css" href="/public/Css/custom.css">
    <link rel="stylesheet" type="text/css" href="/public/Css/select2.css">
    <link href="/public/bower_components/morrisjs/morris.css" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-nolx navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Change Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navlink" href="/admin">Admin Panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a class="navlink" href="/admin">{{ $user['name'] }}</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle navlink" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/editing/users/{{ $user['id']  }}"><i class="fa fa-user fa-fw"></i> My Profile</a>
                        </li>
                        <li><a href="/listing/menu"><i class="fa fa-gear fa-fw"></i> Menu Config</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Exit</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu" ng-controller="getList" ng-init="init('/menu')">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search Placeholder ...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/admin"><i class="fa fa-area-chart"></i> Dashboard</a>
                        </li>
                        <li ng-repeat="item in obj.collection" ng-cloak>
                            <a href="@{{ item.url }}" ng-class="{'active': item.table == '@if(isset($table)){{$table}}@endif'}"><i class="fa fa-edit fa-fw"></i> @{{ item.display_name }}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="/public/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/public/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/public/Js/sb-admin-2.js"></script>
    <script src="/public/bower_components/angular/angular.min.js"></script>
    <script src="/public/bower_components/metisMenu/dist/metisMenu.js"></script>
    <script src="/public/bower_components/raphael/raphael.min.js"></script>

    <script src="/public/Js/select2.full.min.js"></script>
    <script src="/public/Js/jquery.mask.min.js"></script>

    @yield('js')

    <script src="/public/App/app.js"></script>
    <script src="/public/App/ListController.js"></script>
    <script src="/public/App/LoginController.js"></script>
    <script src="/public/App/services.js"></script>


</body>
</html>