<!DOCTYPE html>
<html lang="en" ng-app="Nolx">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Css/scrolling-nav.css">
    <link rel="stylesheet" type="text/css" href="/Css/custom.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    @yield('content')

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="Js/jquery.easing.min.js"></script>
<script src="Js/scrolling-nav.js"></script>
<script src="/bower_components/angular/angular.min.js"></script>
<script src="/App/services.js"></script>
<script src="/App/app.js"></script>

@yield('js')
</body>
</html>