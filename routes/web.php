<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * --------------------------------------------------------------------------------------------
 * Home & Main Routes
 * --------------------------------------------------------------------------------------------
 */
Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/login', function (){
    return view('login');
});

/*
 * --------------------------------------------------------------------------------------------
 * Routes related to Lecturer
 * --------------------------------------------------------------------------------------------
 */
Route::prefix('lecturer')->group(function () {
    Route::get('/', function () {
        return view('lecturer/home');
    });

    Route::get('/create-assignments', function (){
        return view('lecturer/create-assignment');
    });

    Route::get('/manage-students', function (){
        return view('lecturer/manage-students');
    });

    Route::get('/unit/students', function (){
        return view('lecturer/unit-students');
    });

    Route::get('/requests', function (){
        return view('lecturer/requests');
    });

    Route::get('/request-details', function (){
        return view('lecturer/request-details');
    });

    Route::get('/assignments', function (){
        return view('lecturer/unit-assignments');
    });

    Route::prefix('manage-assignments')->group(function () {

        Route::get('/', function (){
            return view('lecturer/manage-assignments');
        });

        Route::get('/assignment/{assignmentNum}/info', function (){
            return view('lecturer/assignment-info');
        });

        Route::get('/assignment/{assignmentNum}/topics-spec', function (){
            return view('lecturer/assignment-topic-spec');
        });

        Route::get('/assignment/{assignmentNum}/topics-allocation', function (){
            return view('lecturer/assignment-topic-allocation');
        });

        Route::get('/assignment/{assignmentNum}/marking-criteria', function (){
            return view('lecturer/assignment-marking-scheme');
        });

        Route::get('/assignment/{assignmentNum}/peer-allocation', function (){
            return view('lecturer/assignment-peer-allocation');
        });

        Route::get('/assignment/{assignmentNum}/deadlines', function (){
            return view('lecturer/assignment-deadline');
        });

        Route::get('/assignment/{assignmentNum}/progress', function (){
            return view('lecturer/assignment-progress');
        });

        Route::get('/assignment/{assignmentNum}/marking-summary', function (){
            return view('lecturer/assignment-marking-summary');
        });

        Route::get('/assignment/{assignmentNum}/marking-details', function (){
            return view('lecturer/assignment-marking-details');
        });

        Route::get('/assignment/{assignmentNum}/results', function (){
            return view('lecturer/assignment-results');
        });
    });
});


/*
 * --------------------------------------------------------------------------------------------
 * Routes related to Student
 * --------------------------------------------------------------------------------------------
 */

Route::prefix('student')->group(function () {
    Route::get('/', function () {
        return view('student/home');
    });

    Route::get('/assignments', function () {
        return view('student/assignments');
    });

    Route::prefix('view')->group(function () {
        Route::get('/assignment/{assignmentNum}/info', function () {
            return view('student/view-assignment');
        });

        Route::get('/assignment/{assignmentNum}/marking-criteria', function () {
            return view('student/view-assignment-marking-scheme');
        });

        Route::get('/assignment/{assignmentNum}/topic-selection', function () {
            return view('student/view-assignment-topic');
        });

        Route::get('/assignment/{assignmentNum}/submission', function () {
            return view('student/view-assignment-submission');
        });

        Route::get('/assignment/{assignmentNum}/marking', function () {
            return view('student/view-assignment-marking');
        });

        Route::get('/assignment/{assignmentNum}/feedback-marking', function () {
            return view('student/view-assignment-feedback-marking');
        });

        Route::get('/assignment/{assignmentNum}/mark/{reviewNum}', function () {
            return view('student/assignment-marking');
        });
    });
});

