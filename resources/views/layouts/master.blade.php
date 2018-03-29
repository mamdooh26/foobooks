<!doctype html>
<html>
<head>
    <title>@yield('title', 'Foobooks')</title>
    <meta charset='utf-8'>
    <link href='/css/foobooks.css' type='text/css' rel='stylesheet'>

    @stack('head')
</head>
<body>

<header>
    <a href='/'><img src='/images/foobooks-logo@2x.png' id='logo' alt='Foobooks Logo'></a>
</header>

<section>
    @yield('content')
</section>

<footer>
    &copy; {{ date('Y') }}
</footer>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

@stack('body')

</body>
</html>