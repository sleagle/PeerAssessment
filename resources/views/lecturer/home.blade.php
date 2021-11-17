@extends('layouts.app')
@section('content')
    <div>
        <nav-bar
            v-bind:redirectLoc="'/lecturer/'">

        </nav-bar>
        <div class="container section box mx-auto" style=" width: 85%; padding-top:10px; margin-top: 150px;">
            <div class="row d-flex justify-content-center" style="margin-top: 50px;">
                <div class="col-sm-6 col-md-5 text-center" data-aos="fadeIn" data-aos-duration="1000">
                    <a href="/lecturer/" style="color: #FF7350; font-size: 24px;">LECTURER HOME</a>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="margin-top: 50px;">
                <div class="col-sm-6 col-md-5 px-3 py-3 ml-3 text-center" data-aos="fadeIn" data-aos-duration="1000">
                    <a class="zoom" href="/lecturer/create-assignments" style="display: inline-block;">
                        <img src="/img/create-assignments.svg" style="width: 400px;">
                    </a>
                </div>

                <div class="col-sm-6 col-md-5 px-3 py-3 ml-3 text-center" data-aos="fadeIn" data-aos-duration="1000">
                    <a class="zoom" href="/lecturer/manage-assignments" style="display: inline-block;">
                        <img src="/img/manage-assignments.svg" style="width: 400px;">
                    </a>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="margin-top: 10px;">
                <div class="col-sm-6 col-md-5 px-3 py-3 ml-3 text-center" data-aos="fadeIn" data-aos-duration="1000">
                    <a class="zoom" href="/lecturer/manage-students" style="display: inline-block;">
                        <img src="/img/manage-students.svg" style="width: 400px;">
                    </a>
                </div>
                <div class="col-sm-6 col-md-5 px-3 py-3 ml-3 text-center" data-aos="fadeIn" data-aos-duration="1000">
                    <a class="zoom" href="/lecturer/requests" style="display: inline-block;">
                        <img src="/img/requests.svg" style="width: 400px;">
                    </a>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="margin-top: 10px; margin-bottom: 100px;">
            </div>
        </div>
    </div>
@endsection
