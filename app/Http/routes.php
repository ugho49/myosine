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
Route::get('/', ['as' => 'index', 'uses' => 'MainController@index']);

Route::get('/tarifs_horaires', ['as' => 'tarifs_horaires', 'uses' => 'TarifHoraireController@index']);

Route::get('/renseignements', ['as' => 'renseignements', 'uses' => 'MainController@renseignements']);

Route::get('/photos', ['as' => 'photos', 'uses' => 'PicturesController@index']);

Route::get('/contact', ['as' => 'contact', 'uses' => 'ContactController@index']);

Route::post('/contact', ['as' => 'contact', 'uses' => 'ContactController@postMessage']);

Route::get('/terms', ['as' => 'terms', 'uses' => 'MainController@terms']);

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', ['as' => 'login', 'uses' => 'UserController@getLogin']);

        Route::post('/login', ['as' => 'login', 'uses' => 'UserController@postLogin']);

        Route::post('/password/reset', ['as' => 'password.reset', 'uses' => 'UserController@resetPassword']);
    });

    Route::get('/logout', ['as' => 'logout', 'uses' => 'UserController@logout', 'middleware' => 'auth']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);

    Route::get('/bandeau', ['as' => 'admin_bandeau', 'uses' => 'AdminBandeauController@index']);

    Route::get('/bandeau/create', ['as' => 'admin_bandeau.create', 'uses' => 'AdminBandeauController@create']);

    Route::post('/bandeau/create', ['as' => 'admin_bandeau.store', 'uses' => 'AdminBandeauController@store']);

    Route::get('/bandeau/{id}/edit', ['as' => 'admin_bandeau.edit', 'uses' => 'AdminBandeauController@edit']);

    Route::post('/bandeau/{id}/edit', ['as' => 'admin_bandeau.update', 'uses' => 'AdminBandeauController@update']);

    Route::get('/bandeau/{id}/remove', ['as' => 'admin_bandeau.remove', 'uses' => 'AdminBandeauController@remove']);

    Route::get('/photo', ['as' => 'admin_photo', 'uses' => 'AdminPhotoController@index']);

    Route::get('photo/all', ['as' => 'admin.photo.all', 'uses' => 'AdminPhotoController@findAll']);

    Route::get('photo/remove/{name}', ['as' => 'admin.photo.remove', 'uses' => 'AdminPhotoController@delete']);

    Route::post('photo/upload', ['as' => 'admin.photo.upload', 'uses' => 'AdminPhotoController@upload']);

    Route::get('/tarif', ['as' => 'admin_tarif', 'uses' => 'AdminTarifController@index']);

    Route::get('/horaires/ouvertures', ['as' => 'admin_horaire_ouv', 'uses' => 'AdminHorairesOuvertureController@index']);

    Route::get('/horaires/cours', ['as' => 'admin_horaire_cours', 'uses' => 'AdminHorairesCoursController@index']);

    Route::get('/settings', ['as' => 'admin_settings', 'uses' => 'AdminSettingsController@index']);

    Route::post('/settings/edit/salle', ['as' => 'informations.update', 'uses' => 'AdminSettingsController@editSalle']);

    Route::post('/settings/edit/user', ['as' => 'user.update', 'uses' => 'UserController@edit']);

    Route::post('/settings/edit/user/password', ['as' => 'user.password.update', 'uses' => 'UserController@editPassword']);
});