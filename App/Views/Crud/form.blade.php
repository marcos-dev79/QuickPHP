@extends('Layout.admin_layout')

@section('content')
        <div class="row">
            <div class="col-lg-12">
                <h3>{{ $tableObj['table_detail']->display_name }}</h3>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">

                <form action="/{{ $tableObj['action'] }}/{{ $table }}" enctype="multipart/form-data" class="form-horizontal" method="post">
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