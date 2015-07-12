<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('archieve', 'HomeController@archieve');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('admin/import/json/{filename}', 'SurveyImportController@importSurveyFromJSON');
Route::get('questions/group/{group_id}', 'HomeController@returnQuestionsAsJSON');
Route::get('questions/survey/{survey_id}', 'HomeController@returnQuestionsAsJSON');
Route::get('question/create', 'QuestionController@create');
Route::get('question/{question_id}', 'HomeController@questionData');


Route::get('surveys/create', 'SurveyController@create');
Route::get('groups/create', 'GroupController@create');
Route::post('groups/save', 'GroupController@save');

Route::get('aboutdi', 'HomeController@aboutpage');
Route::get('methodology', 'HomeController@methodology');
