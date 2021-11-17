<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//routes related to admin controller
Route::prefix('admin')->group(function () {
    Route::post('/create/lecturer', [AdminController::class, 'createLecturer']);
    Route::post('/create/unit', [AdminController::class, 'createUnit']);
});

//Routes related to loginController
Route::prefix('user')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/password/reset', [LoginController::class, 'passwordReset']);
});

//Routes related to lectureController
Route::prefix('lecturer')->group(function () {
    Route::get('/all', [LecturerController::class, 'getAll']);
    Route::get('/units', [LecturerController::class, 'getLecturerUnits'])->middleware('auth.lecturer:api');
});

//Routes related to unitController
Route::prefix('unit')->group(function () {
    Route::middleware('auth.lecturer:api')->group( function () {
        Route::get('/assignments/{unitCode}', [UnitController::class, 'getAssignmentsByUnit']);
        Route::get('/assignment/offerings/{unitCode}', [UnitController::class, 'getAssignmentOfferingsByUnit']);
        Route::post('/add/students', [UnitController::class, 'addStudentsToUnit']);
        Route::get('/students/{unitCode}', [UnitController::class, 'studentsEnrolledIn']);
    });
});

//Routes related to assignmentController
Route::prefix('assignment')->group(function () {
    Route::post('/create', [AssignmentController::class, 'createAssignment']);
    Route::post('/create/criteria', [AssignmentController::class, 'createAssignmentCriteria']);
    Route::get('/{assignmentId}', [AssignmentController::class, 'retrieveAssignment']);
    Route::get('/{assignmentId}/peers', [AssignmentController::class, 'retrieveAssignmentPeers']);
    Route::post('/{assignmentId}/assign-peers', [AssignmentController::class, 'assignPeersForReview']);
    Route::post('/{assignmentId}/update/peers', [AssignmentController::class, 'updateAssignmentPeers']);
    Route::post('/{assignmentId}/update/info', [AssignmentController::class, 'updateAssignmentInfo']);
    Route::post('/{assignmentId}/update/topics', [AssignmentController::class, 'updateAssignmentTopics']);
    Route::post('/{assignmentId}/update/marking-criteria', [AssignmentController::class, 'updateAssignmentMarkingCriteria']);
    Route::post('/{assignmentId}/update/deadline', [AssignmentController::class, 'updateAssignmentDeadline']);

    Route::middleware('auth.lecturer-student:api')->group(function () {
        Route::get('/{assignmentId}/info', [AssignmentController::class, 'retrieveAssignmentInfo']);
        Route::get('/{assignmentId}/topics', [AssignmentController::class, 'retrieveAssignmentTopics']);
        Route::get('/{assignmentId}/marking-criteria', [AssignmentController::class, 'retrieveAssignmentMarkingCriteria']);
        Route::get('/{assignmentId}/deadline', [AssignmentController::class, 'retrieveAssignmentDeadline']);
        Route::get('/{assignmentId}/topic-allocation', [AssignmentController::class, 'retrieveAssignmentTopicAllocation']);
    });
});

//Routes related to StudentController
Route::prefix('student')->middleware('auth.student:api')->group(function () {
    Route::get('/get-units', [StudentController::class, 'getStudentUnits']);
    Route::post('/select-topic', [StudentController::class, 'selectTopicForAssignment']);
    Route::post('/submit', [StudentController::class, 'submitAssignment']);
    Route::post('/review', [StudentController::class, 'peerReviewSubmission']);
    Route::post('/feedback', [StudentController::class, 'provideFeedbackOnReview']);
    Route::get('/unit/assignments/{unitCode}', [StudentController::class, 'getStudentAssignmentsByUnit']);
    Route::get('/unit/pass-enrollments/{unitCode}', [StudentController::class, 'getStudentPastEnrollmentsByUnit']);
    Route::get('/assignment/{assignmentId}/submission-reviews', [StudentController::class, 'getSubmissionReviewsForFeedback']);
    Route::get('/assignment/{assignmentId}/reviews', [StudentController::class, 'getAssignmentReviewsToMake']);
    Route::post('/assignment/give-review', [StudentController::class, 'createAssignmentReview']);
    Route::post('/assignment/give-feedback-review', [StudentController::class, 'createAssignmentFeedbackReview']);
    Route::post('/assignment/enrol-in-topic', [StudentController::class, 'enrolInTopic']);
    Route::post('/assignment/unenroll-from-topic', [StudentController::class, 'unenrollFromTopic']);
});

//Routes related to FileController
Route::prefix('file')->group(function () {
    Route::post('/students-to-unit', [FileController::class, 'addStudentsListsFromCSV']);
    Route::post('/topics-to-assignment', [FileController::class, 'addAssignmentTopicsFromCSV']);
    Route::middleware('auth.student:api')->group(function () {
        Route::post('/assignment-upload', [FileController::class, 'uploadAssignment']);
    });
});
