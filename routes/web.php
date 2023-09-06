<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Models\Question;

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

Route::get('/', function () {
    $questions = Question::where('status',1)->orderBy('id','desc')->paginate(4);
    return view('welcome',compact('questions'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//question store
Route::post('/store/question',[QuestionController::class,'storeQuestion'])->name('question.store');
Route::get('/delete/question/{id}',[QuestionController::class,'deleteQuestion'])->name('question.delete');
Route::get('/answer/view/{id}',[QuestionController::class,'answerView'])->name('answer.view');
Route::post('/answer/store',[QuestionController::class,'answerStore'])->name('answer.store');
Route::get('/setting',[QuestionController::class,'setting'])->name('setting');
Route::post('/change/approve/status/{id}',[QuestionController::class,'cahngeApproveStatus'])->name('change.approve.status');
Route::get('/question/approve/{id}',[QuestionController::class,'questionApprove'])->name('question.approve');
