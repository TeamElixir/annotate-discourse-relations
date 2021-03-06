<?php

use App\SimpleRelation;

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

Route::get('/analyse-relationship', [
    'as' => 'analyse-relationship',
    function () {
        $simple_relations = SimpleRelation::all();

        return view('analyse-discourse-relationship', [
            'simple_relations' => $simple_relations
        ]);
    }
]);

Route::post('ajax-check-relationship', [
    'uses' => 'AnalyzeRelationshipController@ajax'
]);

Route::post('/submit-sentences', [
    'uses' => 'AnalyzeRelationshipController@main'
])->name('submit-sentences');

Route::get('shift-in-views', [
    'uses' => 'ShiftInViewsController@index'
])->name('shift-in-views');

Route::post('/not-defined', [
    'uses' => 'PagesController@tempPost'
])->name('not-defined');

//Route::get('/temp', [
//    'uses' => 'TempController@shuffleAndCluster'
//]);

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

// API
Route::get('/api/pairs', 'api\SentencePairsApi@search');
Route::get('/api/sentences', 'api\SentencesApi@search');
Route::get('/api/annotations', 'api\AnnotationsApi@getAllAnnotations');
Route::get('/api/annotations/{user_id}', 'api\AnnotationsApi@getAnnotationsOfuser');
Route::get('/api/relations', 'api\RelationsApi@getAllRelations');
Route::get('/api/relations/{id}', 'api\RelationsApi@getRelationById');
