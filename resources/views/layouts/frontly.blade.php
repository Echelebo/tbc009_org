<!DOCTYPE html>
<html>

<meta http-equiv="/kringle/in/content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LKRV3PDKK8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LKRV3PDKK8');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="/kringle/out/maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/kringle/out/stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/kringle/out/use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="/kringle/out/cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="/kringle/out/ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="/kringle/in/content/css/style.css" rel="stylesheet" />
    <title>{{ site('name') }}: {{ $page_title }}</title>
    <meta name="description" content="{{ $short_description }}">
    <meta name="keywords"
        content="TBC009 Exchange, TBC009 wallet, Recover your TBC balance, New TBC009 wallet, TBC009 login">
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript"
        src="/kringle/out/translate.google.com/translate_a/elementa0d8.js?cb=googleTranslateElementInit"></script>
</head>

<body>

    <nav id="TopNav" class="navbar navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">
            <img id="logo" src="/kringle/in/content/img/logo_75.png" />
        </a>
        <!--<ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link navbar-header" href="#"><img id="logo" src="./content/img/dark_logo_50.png" /> </a>
        </li>
    </ul>-->
        <div class="navbar-expand" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <div id="google_translate_element" style="margin-top: 18px"></div>
                <div style="margin-top: 11px;margin-left: 45px;">
                    <a href="https://youtu.be/V6b5XnjrIzo" target="_blank">
                        <img src="/kringle/in/content/img/noitulover.png" />
                    </a>
                </div>
            </div>
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{ route('user.login') }}">Login</a>
                <a class="nav-item nav-link" href="{{ route('user.register') }}">Register</a>
                <a class="nav-item nav-link" href="{{ route('publicnotice') }}">Public Notice</a>
                <a class="nav-item nav-link" href="{{ route('tos') }}">Terms Of Use</a>
                <a class="nav-item nav-link" href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>
            </div>


        </div>

    </nav>
    <nav aria-label="breadcrumb">

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('user.login') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('publicnotice') }}">Public Notice</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
        </ol>
    </nav>


    @yield('contents')

    <div id="footer" class="nav-background-footer">

    </div>
    <div style="height:100px"></div>
</body>

<!-- Mirrored from kringle.cash/terms_of_use.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Mar 2024 12:07:29 GMT -->

</html>

<script src="/kringle/out/ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/kringle/out/ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="/kringle/out/cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="/kringle/out/cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="/kringle/out/cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<!-- I'm not sure if the menu is boggling this up or not. But somehow $.modal doesn't work -->
<!-- I've just been re-importing it in my code below the include header -->
<script src="/kringle/out/maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!-- Insure a fresh load of this each time. -->
<script src="/kringle/in/code/js/_main_menue32c.js?random=65fad1752f896"></script>

<script src="/kringle/out/cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.1/bootbox.min.js"></script>

<!-- MDB -->
