@extends('Layout.base_layout')

@section('content')
    <div class="container" ng-controller="ctrLogin" >
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 ng-if="formData.name" ng-cloak class="panel-title">Welcome back, @{{ formData.name }}</h3>
                        <h3 ng-if="!formData.name" ng-cloak class="panel-title">Access</h3>
                    </div>
                    <div class="panel-body" ng-init="onLoadCookie()">
                        <form id="login" name="login" ng-submit="submit()" method="post" novalidate>
                            <fieldset>
                                <div class="form-group" ng-class="{ 'has-error' : login.email.$invalid && !login.email.$pristine }">
                                    <input required ng-model="formData.email" class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group" ng-class="{ 'has-error' : login.password.$invalid && !login.password.$pristine }">
                                    <input required ng-model="formData.senha" class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" ng-model="formData.remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                    
                                    <p class="cookieinfo">This site uses cookies and other tracking technologies to assist with navigation 
                                    and your experience within the application. 
                                    By clicking the checkbox, you agree with the use of cookies.</p>
                                </div>
                                
                                <button type="button" ng-disabled="login.$invalid" ng-click="submit()" class="btn btn-lg btn-success btn-block">
                                    <i class="fa fa-login"></i> Connect
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