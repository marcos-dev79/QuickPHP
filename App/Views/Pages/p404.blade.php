@extends('Layout.base_layout')

@section('content')

    <section id="p404" class="p404-section">
        <div class="margin-top-init"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h2>404 - Page not found.</h2>
                    <p class="lead"><i class="fa fa-info-circle"></i> Go back to the home page and try again.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-left mg-top">
                    <a href="/" class="btn btn-lg btn-primary"><i class="fa fa-arrow-circle-left"></i> Home</a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        });
    </script>
@endsection