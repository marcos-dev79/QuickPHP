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

                    <input type="submit" class="btn btn-success" value="Save" />
                </form>
            </div>
            <div class="col-lg-6">
                <!-- something here -->
            </div>
        </div>
@endsection

@section('js')

    <script>
        $(document).ready(function(){
            $('.date').mask('00/00/0000');
            $('.time').mask('00:00:00');
            $('.date_time').mask('00/00/0000 00:00:00');
            $('.cep').mask('00000-000');
            $('.phone').mask('0000-0000');
            $('.mobile').mask('(00) 00000-0000');
            $('.phone_with_ddd').mask('(00) 0000-0000');
            $('.phone_us').mask('(000) 000-0000');
            $('.mixed').mask('AAA 000-S0S');
            $('.cpf').mask('000.000.000-00', {reverse: true});
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
            $('.money').mask('000.000.000.000.000,00', {reverse: true});
            $('.money2').mask("#.##0,00", {reverse: true});
            $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                'Z': {
                    pattern: /[0-9]/, optional: true
                }
                }
            });
            //$('.ip_address').mask('099.099.099.099');
            $('.percent').mask('##0,00%', {reverse: true});
            $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
            $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
            $('.fallback').mask("00r00r0000", {
                translation: {
                    'r': {
                    pattern: /[\/]/,
                    fallback: '/'
                    },
                    placeholder: "__/__/____"
                }
                });
            $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
        });
    </script>


    @include('Crud.datepickerInc')
@endsection