@extends('Layout.base_layout')

@section('content')
    <div class="container" ng-controller="ctrLogin as vm" ng-cloak>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 ng-if="formData.name" ng-cloak class="panel-title">@{{ formData.lang.WELBCK }}, @{{ formData.name }}</h3>
                        <h3 ng-if="!formData.name" ng-cloak class="panel-title">@{{ formData.lang.ACCESS }}</h3>
                    </div>
                    <div class="panel-body" ng-init="vm.onLoadCookie()">
                        <form id="login" name="login" ng-submit="vm.submit()" method="post" novalidate>
                            <fieldset>
                                <div class="form-group" style="text-align: right" >
                                    <img src="/public/img/br.png" class="pointer" ng-click="vm.changeLang('pt-br')">
                                    <img src="/public/img/usa.png" class="pointer" ng-click="vm.changeLang('en-us')">
                                </div>
                                <div class="form-group" ng-class="{ 'has-error' : login.email.$invalid && !login.email.$pristine }">
                                    <input required ng-model="formData.email" class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group" ng-class="{ 'has-error' : login.password.$invalid && !login.password.$pristine }">
                                    <input required ng-model="formData.senha" class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" ng-model="formData.remember" type="checkbox">@{{ formData.lang.REMEMBER }}
                                    </label>
                                    
                                    <p class="cookieinfo">@{{ formData.lang.COOKIE }}</p>
                                </div>
                                
                                <button type="button" ng-disabled="login.$invalid" ng-click="vm.submit()" class="btn btn-lg btn-success btn-block">
                                    <i class="fa fa-login"></i> @{{ formData.lang.CONNECT }}
                                </button>
                            </fieldset>
                        </form>
                        <div class="messageBox" ng-cloak>@{{ msg }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection