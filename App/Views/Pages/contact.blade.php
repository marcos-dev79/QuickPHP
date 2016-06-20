@extends('Layout.base_layout')

@section('content')
<h2>Form</h2>

<form action="/contact" method="post">
    <input type="text" value="test" />
    <input type="submit" value="Enviar" />
</form>
@endsection