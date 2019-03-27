@extends('Layout.admin_layout')

@section('content')
        <div class="row">
            <div class="col-lg-12">

                @if(isset($tableObj['table_detail']->display_name))
                <h3>{{ $tableObj['table_detail']->display_name }}</h3>
                @else
                <p><i class="glyphicon glyphicon-remove-circle"></i> There is an error in your table configuration. Please check the table comment</p>                
                @endif
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">

                <form novalidate name="form_{{ $table }}" action="/{{ $tableObj['action'] }}/{{ $table }}@if($tableObj['action'] == 'editing')/{{ $tableObj['id'] }}@endif"
                      enctype="multipart/form-data"
                      class="form-horizontal"
                      method="post">
                    @forelse($html as $h)
                        {!! $h !!}
                    @empty
                        <p>Empty.</p>
                    @endforelse

                    @if($tableObj['action'] == 'editing')
                        <input type="hidden" name="id" id="id" value="{{ $tableObj['id'] }}" />
                    @endif

                    <input type="submit" class="btn btn-success" value="Gravar" />
                </form>
            </div>
            <div class="col-lg-6">
                <!-- something here -->
            </div>
        </div>
@endsection

@section('js')
    <script src="/public/bower_components/tinymce/tinymce.min.js"></script>
    @include('Crud.datepickerInc')
@endsection