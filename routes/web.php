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

Route::post('annotations/create', 'AnnotationsController@createAnnotation');

// Google login
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('redirect-to-provider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback')->name('handle-provider-callback');

Route::get('/temp', function () {
   return 'successful';
});


// API
Route::get('/api/pairs', 'api\SentencePairsApi@search');
Route::get('/api/sentences', 'api\SentencesApi@search');
Route::get('/api/annotations', 'api\AnnotationsApi@getAllAnnotations');
Route::get('/api/annotations/{user_id}','api\AnnotationsApi@getAnnotationsOfuser');
Route::get('/api/relations', 'api\RelationsApi@getAllRelations');
Route::get('/api/relations/{id}', 'api\RelationsApi@getRelationById');
