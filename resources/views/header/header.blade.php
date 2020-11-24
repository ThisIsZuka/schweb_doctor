    @section('header')
        {{-- <nav
            class="col-12 navbar navbar-expand-lg navbar-dark bg-dark fixed-top header alt-color">
            <a class="navbar-brand" href="#"><img src="{{ asset('Image/logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse nav content-end" id="navbarSupportedContent">

                <form class="form-inline my-2 my-lg-0 ">
                    <span class="field__label">First name</span>
                    </span>
                </form>

            </div>
        </nav> --}}
        <div class="navbar-fixed">
            <nav class="header alt-color">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo"><img src="{{ asset('Image/logo.png') }}"></a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="sass.html">Sass</a></li>
                        <li><a href="badges.html">Components</a></li>
                        <li><a href="collapsible.html">JavaScript</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">Javascript</a></li>
            <li><a href="mobile.html">Mobile</a></li>
        </ul>

    @endsection
