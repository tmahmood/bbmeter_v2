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

Route::get('questions/group/{group_id}', 'HomeController@returnQuestionsAsJSON');
Route::get('questions/survey/{survey_id}', 'HomeController@returnQuestionsAsJSON');
Route::get('question/{question_id}', 'HomeController@questionData');

Route::get('admin/import/json/{filename}', 'SurveyImportController@importSurveyFromJSON');
Route::get('admin/import/sources', 'SurveyImportController@listAllUploadedSources');
Route::get('admin/questions/create', 'QuestionController@create');
Route::post('admin/questions/save', 'QuestionController@save');

Route::get('admin/surveys/create', 'SurveyController@create');
Route::post('admin/surveys/save', 'SurveyController@save');

Route::get('admin/groups/create', 'GroupController@create');
Route::post('admin/groups/save', 'GroupController@save');


Route::get('aboutdi', 'HomeController@aboutpage');
Route::get('methodology', 'HomeController@methodology');
