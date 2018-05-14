<?php

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

Route::get('/', [
    'uses' => 'PagesController@getHomePage',
]);

Route::get('/raw-sentences', [
    'uses' => 'SentencesController@getAllSentences',
]);

Route::get('/raw-sentence-pairs', [
    'uses' => 'SentencePairsController@getAllSentencePairs'
]);

Route::get('sentence/{id}', [
    'uses' => 'SentencesController@getSentenceById'
]);

Route::get('sentence-pair/{id}', [
    'uses' => 'SentencePairsController@getSentencePairById'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api/pairs', 'api\SentencePairsApi@search');
Route::get('/api/sentences', 'api\SentencesApi@search');

Route::get('/api/annotations', 'api\AnnotationsApi@getAllAnnotations');
Route::get('/api/annotations/{user_id}','api\AnnotationsApi@getAnnotationsOfuser');