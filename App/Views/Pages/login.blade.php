@extends('Layout.base_layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Efetuar conexão</h3>
                    </div>
                    <div class="panel-body" ng-controller="ctrLogin">
                        <form id="login" name="login" ng-submit="submit()" method="post" novalidate>
                            <fieldset>
                                <div class="form-group" ng-class="{ 'has-error' : login.email.$invalid && !login.email.$pristine }">
                                    <input required ng-model="formData.email" class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group" ng-class="{ 'has-error' : login.password.$invalid && !login.password.$pristine }">
                                    <input required ng-model="formData.senha" class="form-control" placeholder="Senha" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Lembrar Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="button" ng-disabled="login.$invalid" ng-click="submit()" class="btn btn-lg btn-success btn-block">
                                    <i class="fa fa-login"></i> Conectar
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