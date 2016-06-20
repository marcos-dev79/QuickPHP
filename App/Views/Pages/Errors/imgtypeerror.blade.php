@extends('Layout.admin_layout')

@section('content')
    <div class="sm-marg"></div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h2>O tipo de arquivo selecionado para upload não é compatível.</h2>
            <p>Verifique se o tipo da imagem é compatível com o informado no formulário.</p>
            <p><a href="javascript:;" onclick="history.back();"><i class="fa fa-arrow-circle-left"></i> Voltar</a> </p>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('js')

@endsection