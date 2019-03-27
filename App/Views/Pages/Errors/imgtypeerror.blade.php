@extends('Layout.admin_layout')

@section('content')
    <div class="sm-marg"></div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h2>This type of file is not allowed.</h2>
            <p>Also, it may be the right type, but the size is bigger than allowed. </p>
            <p><a href="javascript:;" onclick="history.back();"><i class="fa fa-arrow-circle-left"></i> Back</a> </p>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('js')

@endsection