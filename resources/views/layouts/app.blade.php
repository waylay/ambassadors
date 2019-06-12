<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald:500,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/select/1.3.0/css/select.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/scroller/2.0.0/css/scroller.dataTables.min.css">


    {!! NoCaptcha::renderJs() !!}

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-md">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="{{ asset('images/logo-hh.png') }}" alt="{{ config('app.name', 'Laravel') }}">
                </a>
                <h4 class="mb-0 ml-4 ml-sm-0">Ambassador Program</h4>

                @guest

                @else
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                    </ul>
                </div>
                @endguest
            </div>
        </nav>

        <main class="py-4">

            @yield('content')

            @if(Request::is('dashboard*'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="card bg-dark text-white">
                                <div class="card-header">System Information</div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Administrator</p>
                                            <p><strong>{{ Auth::user()->name }}</strong> </p>
                                        </div><!-- /.col-md-4 -->
                                        <div class="col-md-4">
                                            <p>Ambassadors</p>
                                            <h4><strong>{{ \App\Ambassador::count() }}</strong></h4>
                                        </div><!-- /.col-md-4 -->
                                        <div class="col-md-4">
                                            <p>Referrals</p>
                                            <h4><strong>{{ \App\Referral::count() }}</strong></h4>
                                        </div><!-- /.col-md-4 -->
                                    </div><!-- /.row -->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            @endif
        </main>

        <!-- Footer -->
        <footer class="page-footer font-small bg-primary text-white pt-5">

        <!-- Footer Links -->
        <div class="container text-center text-md-left">

          <!-- Grid row -->
          <div class="row">

            <!-- Grid column -->
            <div class="col-md-8 mt-md-0 mt-3">

              <!-- Content -->
              <h4 class="mb-2">HH Staffing Services</h4>
              <p>Our mission is to be the most respected staffing firm in each market we serve by providing best-in-class, extra-mile workforce solutions to our valued clients and associate employees. We serve clients in Florida and throughout the entire United States.</p>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none pb-3">


            <!-- Grid column -->
            <div class="col-md-3 offset-md-1 mb-md-0 mb-3">

              <!-- Links -->
              <h4 class="mb-2">Talk to us</h4>

              <ul class="list-unstyled">
                <li>
                  <a href="tel:9417516262" class="text-white">Phone: (941) 751-6262 </a>
                </li>
                <li>Fax: (941) 758-5424</li>
              </ul>

            </div>
            <!-- Grid column -->

          </div>
          <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center text-info py-3">© {{ date('Y') }} Copyright
          <a href="https://hhstaffingservices.com/" class="text-white"> HH Staffing Services</a>. <br class="d-block d-md-none">All rights reserved.
        </div>
        <!-- Copyright -->

      </footer>
      <!-- Footer -->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.2.0/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.56/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.56/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>




    @stack('scripts')

</body>
</html>
