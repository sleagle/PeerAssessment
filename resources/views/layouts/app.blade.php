<!doctype html>
<html lang="en">
<head>
    <title>PASS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/ico" href="{{ asset('svg/logos/pas-logo-short.svg') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>


</head>
<body>
    <div id="app">
        <section>
            <div id="content">
                @yield('content')
            </div>
            <div>
                <footer class="footer">
                    <div class="row" style="margin-top: 100px;margin-right: 0px;margin-left: 0px;">
                        <div class="col text-center">
                            <hr>
                            <p class="copyright">&copy; UTAS-ICT Discipline 2021. All rights reserved.</p>
                        </div>
                    </div>
                </footer>
            </div>
        </section>
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/bs-init.js') }}"></script>
    <script src="{{ asset('/js/smooth-scrollspy.js') }}"></script>
    <script src="{{ asset('/js/scrollspy.js') }}"></script>
    <script src="{{ asset('/js/smooth-scrollspy-home.js') }}"></script>
    <script src="{{ asset('/js/scrollspy-home.js') }}"></script>
    <script src="{{ asset('/js/lecturer-create-assignment.js') }}"></script>
    <script src="{{ asset('/js/view-assignment.js') }}"></script>
    <script src="{{ asset('/js/dropzone.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://kit.fontawesome.com/1835b2fabe.js" crossorigin="anonymous"></script>

</body>
</html>
