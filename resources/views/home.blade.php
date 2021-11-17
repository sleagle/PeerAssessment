@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #274f73;">
        <nav class="container"><a class="navbar-brand" href="/home"
                                  style="background-image: url(&quot;/img/pas-logo-light.svg&quot;);
                                  background-position: center;background-size: auto;
                                  background-repeat: no-repeat;width: 100px;height: 50px;"></a>
            <button type="button" data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1" style="width: 700px; margin-left: 30px;">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#section1">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section2">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section3">Contact</a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">

                </form><a class="btn btn-light action-button" role="button" href="/login"
                          style="font-size: 14px; color: #274F73;">Log In</a>
            </div>
        </nav>
    </nav>

    <!--=========== Main class ===============-->
    <div>
        <!--==== Home =======-->
        <div id="section1" class="section">
            <br><br>
            <div class="container">
                <div style="padding-bottom: 30px;">
                    <div class="container text-center">
                        <div class="w-md-75 mx-md-auto mb-5 mt-5" style="text-align: center;">
                            <h2 class="slideInUp animated" style="font-family: 'Noto Serif', serif; color: #274F73;
                             font-size: 40px;">True assessment from peers</h2>
                            <p class="lead zoomIn animated" style="width: 70%; display: inline-block;
                            font-family: 'Roboto', sans-serif;">
                                How you evaluate other student's assignments is also the way your assignments are assessed
                                fairly, effectively and efficiently! </p>
                        </div>

                        <div class="mb-9">
                            <video width="70%" controls autoplay muted>
                                <source src="/videos/ICT student introduction.mp4" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--========== End Home ==========-->

        <!--======== About Us===========-->
        <div id="section2" class="section">
            <br><br>
            <div class="container space-2 space-md-1 border-top" style="padding-bottom: 10px;">
                <br>
                <!-- Title -->
                <div class="w-md-75 w-lg-50 text-center text-md-left mb-3">
                    <h2 class="h3 font-weight-normal" style="font-family: 'Noto Serif', serif; color: #274F73; margin-top: 30px; font-size: 30px;">
                        Fantastic experiences with UTAS ICT Discipline proved by active and creative learning activities.</h2>
                    <br>
                </div>
                <!-- End Title -->

                <div class="svg-preloader card-deck card-lg-gutters-2 d-block d-lg-flex" style="text-align: center">
                    <div class="card shadow mb-3 mb-lg-0" style="height: auto; display: inline-block">
                        <!-- Icon Blocks -->
                        <div class="card-body p-2">
                            <figure class="ie-height-56 w-100 max-width-8 mb-2">
                                <img class="js-svg-injector" src="/svg/intro.svg" alt="SVG"
                                     data-parent="#SVGkeyFeatures">
                            </figure>
                            <h3 class="h5" style="color: #177dd7;">Introduction</h3>
                            <p class="font-size-1">Every staff and student is well cooperated with live experience in studying and working.</p>
                            <a class="font-size-1" href="#">Explore now</a>
                        </div>
                        <!-- End Icon Blocks -->
                    </div>

                    <div class="card shadow mb-3 mb-lg-0" style="height: auto; display: inline-block">
                        <!-- Icon Blocks -->
                        <div class="card-body p-2">
                            <figure class="ie-height-56 w-100 max-width-8 mb-2">
                                <img class="js-svg-injector" src="/svg/high-quality.svg" alt="SVG"
                                     data-parent="#SVGkeyFeatures">
                            </figure>
                            <h3 class="h5" style="color: #177dd7;">High quality</h3>
                            <p class="font-size-1">ICT has provided a range of cutting-edge courses which strongly support your future careers.</p>
                            <a class="font-size-1" href="#">Explore now</a>
                        </div>
                        <!-- End Icon Blocks -->
                    </div>

                    <div class="card shadow mb-3 mb-lg-0" style="height: auto; display: inline-block">
                        <!-- Icon Blocks -->
                        <div class="card-body p-2">
                            <figure class="ie-height-56 w-100 max-width-8 mb-2">
                                <img class="js-svg-injector" src="/svg/premi.svg" alt="SVG"
                                     data-parent="#SVGkeyFeatures">
                            </figure>
                            <h3 class="h5" style="color: #177dd7;">Premium <span class="badge badge-info font-weight-medium badge-pill ml-1">qualified</span></h3>
                            <p class="font-size-1">ICT is not only for study, but also for working known as top-level choices from UTAS's students.</p>
                            <a class="font-size-1" href="#">Explore now</a>
                        </div>
                        <!-- End Icon Blocks -->
                    </div>

                    <div class="card shadow mb-3 mb-lg-0" style="height: auto; display: inline-block">
                        <!-- Icon Blocks -->
                        <div class="card-body p-2">
                            <figure class="ie-height-56 w-100 max-width-8 mb-2">
                                <img class="js-svg-injector" src="/svg/real.svg" alt="SVG"
                                     data-parent="#SVGkeyFeatures">
                            </figure>
                            <h3 class="h5" style="color: #177dd7;">Real experience</h3>
                            <p class="font-size-1">ICT Discipline is an incredibly beautiful, fantastic and creative study place of UTAS.</p>
                            <a class="font-size-1" href="#">Explore now</a>
                        </div>
                        <!-- End Icon Blocks -->
                    </div>
                </div>
            </div>
        </div>
        <!--========== End About Us ==========-->

        <!--======== Contact ===========-->
        <div id="section3" class="section">
            <br><br>
            <div class="clearfix">
                <br>
                <div class="container border-top">
                    <!-- Input for requests from students-->
                    <div class="contact-clean" style="text-align: center; padding-top: 10px; padding-bottom: 80px;">
                        <!-- Title -->
                        <div class="w-md-75 w-lg-50 mx-md-auto mb-4 pt-2">
                            <h3 style="font-family: 'Abril Fatface', cursive; font-size: 60px; color: #274F73;">Question?</h3>
                            <p style="color: #dd6446;">Fill in the following fields to get in touch with us!</p>
                        </div>
                        <!-- End Title -->

                        <form method="post" style=" width: 75%; display: inline-block; border-radius: 8px;">
                            <!--Form groups-->
                            <div class="form-group" style="text-align: center;"><input class="form-control" type="text" name="name" placeholder="Name:       Van Y Pham" style="width: 90%; display: inline-block;"></div>
                            <div class="form-group" style="text-align: center;"><input type="email" class="form-control" name="email" placeholder="Email:        vypham@utas.edu.au" style="width: 90%; display: inline-block;"></div>
                            <div class="form-group" style="text-align: center;"><textarea class="form-control" name="message" placeholder="Message:  Hi there, I would like to..." rows="10" style="width: 90%; display: inline-block;"></textarea></div>
                            <div class="form-group float-right"><button class="btn send-btn zoom" type="submit" style="margin-right: 40px;">Send </button></div>
                            <!--End Form groups-->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
