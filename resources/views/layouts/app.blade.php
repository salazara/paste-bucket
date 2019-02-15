<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>paste-bucket</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link 
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        rel="stylesheet" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">

    <!-- jQuery -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
      crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #ccc;
        }
        a {
            color: black;
            text-decoration: none;
        }
        a:hover {
            color: grey;
            text-decoration: none;
        }
        .fa {
            margin-left: 5px;
            margin-right: 5px;
        }
        .pb-input {
            width: 100%; 
            padding: 5px 10px;
            border: 1px solid #ccc;
        }
        .pb-textarea {
            width: 100%; 
            resize: none;
            padding: 10px;
            font-family: Monaco;
            font-size: 12px;
            border: 1px solid #ccc;
        }
        .pb-button {
            padding: 5px; 
            background-color: white; 
            border-radius: 5px; 
            border: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    paste-bucket
                </a>
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
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>

        // https://stackoverflow.com/questions/1909441/how-to-delay-the-keyup-handler-until-the-user-stops-typing
        var delay = (function(){
            
            var timer = 0;
            
            return function(callback, ms){
            
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };

        })();

        function pb_search() {

            delay(function() {

                let searchInput = $('#pb-search-input').val().toLowerCase();

                let dashboard = document.getElementById('dashboard');

                let pastes = dashboard.getElementsByClassName('pb-paste');

                let pasteTitles = dashboard.getElementsByClassName('pb-paste-title');

                for(let i = 0 ; i < pasteTitles.length ; i++){

                    let pasteTitle = pasteTitles[i].innerHTML.toLowerCase().trim();
                    console.log(pasteTitle);

                    if (pasteTitle.indexOf(searchInput) > -1) {

                        pastes[i].style.display = 'block';

                    } else {

                        pastes[i].style.display = 'none';

                    }

                }

            }, 500);

        }

        function pb_copy(id, copyMultipler) {

            
            let copyFrom = document.createElement("textarea");
            document.body.appendChild(copyFrom);

            //copyFrom.textContent = $('#' + id).val();
            copyFrom.textContent = "";
            for(var i = 0 ; i < copyMultipler ; i++){
                copyFrom.textContent += pb_decode_curly_braces($('#' + id).val()) + '\n';
            }        

            copyFrom.select();
            document.execCommand("copy");
            copyFrom.remove();

        }

        function pb_select_copy_multiplier(o, id){

            document.getElementById(id).innerHTML = o.value;
        
        }

        function pb_delete_paste(id) {

            if(confirm('Delete?')){

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '/paste/destroy',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN, 
                        id: id
                    },
                    dataType: 'JSON',
                    complete: function (data) { 
                        window.location.href = '/home';
                    }
                }); 

            }

        }

        function pb_decode_curly_braces(input){
            return input.replace(/&#123;/g, '{').replace(/&#125;/g, '}');
        }
    </script>
</body>
</html>
