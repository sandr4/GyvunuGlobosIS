    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Gyvūnų Globa</a>
               
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('/') }}">Pagrindinis</a>
                    </li>
                    @if(Auth::check())
                    <li>
                        <a href="{{ url('animals') }}">Gyvūnai</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ url('/') }}">Kontaktai</a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}">Apie</a>
                    </li>
                </ul>
                <!-- /. Login form -->
                @if(!Auth::check())
                    @include('GyvunuGloba.Layout.Partials.login')
                @else
                    @include('GyvunuGloba.Layout.Partials.profile')
                @endif
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    @if(Auth::check())
        @if(Auth::user()->state->id >= 3)
            <div class="alert alert-warning col-md-12 text-center">
                <strong>
                    <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
                    Elektroninis paštas nepatvirtintas. <a href="{{ url('email/resend_confirm') }}">Persiųsti patvirtinimą?</a>
                </strong>
            </div>
        @endif
    @endif
    <!-- /.Registartion form -->
    @if(!Auth::check())
        @include('GyvunuGloba.Layout.Partials.register')
    @endif
