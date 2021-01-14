<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>Administrace | {{config('app.name')}}</title>

    <!-- CSS -->
    <link href="{{ asset('vendor/admin/css/app.css') }}"
          rel="stylesheet">

    {{-- jQuery --}}
    <link rel="stylesheet"
          href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-light fixed-top navbar-toggleable-md  bg-faded">
            <div class="navbar-brand">
                <a href="{{route('admin::index')}}"
                   style="color: white"><b>{{config('app.name')}}</b> - Administrace</a>
            </div>
            <ul class="navbar-nav mr-auto">
            </ul>
            <a href="#menu-toggle"
               class="btn btn-default"
               id="menu-toggle"><i class="fa fa-bars"
                                   aria-hidden="true"></i></a>
            <a href="/"
               class="btn btn-login"
               style="margin-right: 1em">Zobrazit web</a>

            @auth
                <form action="{{ route('logout') }}"
                      method="post">
                    <input type="hidden"
                           name="_token"
                           value="{{ csrf_token() }}">
                    <button type="submit"
                            class="btn btn-login">Odhlásit
                    </button>
                </form>
            @endauth
        </nav>

        <div id="wrapper"
             class="toggled">
            <!-- sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    @include('admin::components.menu')
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                {{--            @include('toast::messages')--}}

                @yield('content')

            </div><!-- /#page-content-wrapper -->

        </div>
    </div>

    @stack('scripts')
</body>
</html>
