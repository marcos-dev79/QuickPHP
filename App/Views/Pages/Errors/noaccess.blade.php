@extends('Layout.base_layout')

@section('content')
    <div class="container">
        <div class="sm-marg"></div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h2>Você não possui acesso à esta página.</h2>
                <p>Verifique com o administrador do sistema.</p>
                <p><a href="/login"><i class="fa fa-arrow-circle-left"></i> Refazer o login</a> </p>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('js')

@endsection