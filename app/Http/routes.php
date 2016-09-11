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

    Route::group(['prefix' => 'bandeau'], function () {
        Route::get('/', ['as' => 'admin_bandeau', 'uses' => 'AdminBandeauController@index']);

        Route::get('/create', ['as' => 'admin_bandeau.create', 'uses' => 'AdminBandeauController@create']);

        Route::post('/create', ['as' => 'admin_bandeau.store', 'uses' => 'AdminBandeauController@store']);

        Route::get('/{id}/edit', ['as' => 'admin_bandeau.edit', 'uses' => 'AdminBandeauController@edit']);

        Route::post('/{id}/edit', ['as' => 'admin_bandeau.update', 'uses' => 'AdminBandeauController@update']);

        Route::get('/{id}/remove', ['as' => 'admin_bandeau.remove', 'uses' => 'AdminBandeauController@remove']);
    });

    Route::group(['prefix' => 'photo'], function () {
        Route::get('/', ['as' => 'admin_photo', 'uses' => 'AdminPhotoController@index']);

        Route::get('/all', ['as' => 'admin.photo.all', 'uses' => 'AdminPhotoController@findAll']);

        Route::get('/remove/{name}', ['as' => 'admin.photo.remove', 'uses' => 'AdminPhotoController@delete']);

        Route::post('/upload', ['as' => 'admin.photo.upload', 'uses' => 'AdminPhotoController@upload']);
    });

    Route::group(['prefix' => 'tarif'], function () {
        Route::get('/', ['as' => 'admin_tarif', 'uses' => 'AdminTarifController@index']);

        Route::get('/create', ['as' => 'admin_tarif.create', 'uses' => 'AdminTarifController@create']);

        Route::post('/create', ['as' => 'admin_tarif.store', 'uses' => 'AdminTarifController@store']);

        Route::get('/{id}/edit', ['as' => 'admin_tarif.edit', 'uses' => 'AdminTarifController@edit']);

        Route::post('/{id}/edit', ['as' => 'admin_tarif.update', 'uses' => 'AdminTarifController@update']);

        Route::get('/{id}/remove', ['as' => 'admin_tarif.remove', 'uses' => 'AdminTarifController@remove']);
    });

    Route::group(['prefix' => 'horaires'], function () {
        Route::group(['prefix' => 'ouvertures'], function () {
            Route::get('/', ['as' => 'admin_horaire_ouv', 'uses' => 'AdminHorairesOuvertureController@index']);

            Route::get('/{id}/edit', ['as' => 'admin_horaire_ouv.edit', 'uses' => 'AdminHorairesOuvertureController@edit']);

            Route::post('/{id}/edit', ['as' => 'admin_horaire_ouv.update', 'uses' => 'AdminHorairesOuvertureController@update']);

            Route::get('/{id}/remove', ['as' => 'admin_horaire_ouv.remove', 'uses' => 'AdminHorairesOuvertureController@remove']);
        });

        Route::group(['prefix' => 'cours'], function () {
            Route::get('/', ['as' => 'admin_horaire_cours', 'uses' => 'AdminHorairesCoursController@index']);

            Route::get('/create', ['as' => 'admin_horaire_cours.create', 'uses' => 'AdminHorairesCoursController@create']);

            Route::post('/create', ['as' => 'admin_horaire_cours.store', 'uses' => 'AdminHorairesCoursController@store']);

            Route::get('/{id}/edit', ['as' => 'admin_horaire_cours.edit', 'uses' => 'AdminHorairesCoursController@edit']);

            Route::post('/{id}/edit', ['as' => 'admin_horaire_cours.update', 'uses' => 'AdminHorairesCoursController@update']);

            Route::get('/{id}/remove', ['as' => 'admin_horaire_cours.remove', 'uses' => 'AdminHorairesCoursController@remove']);

            Route::group(['prefix' => 'type'], function () {
                Route::get('/', ['as' => 'admin_type_cours', 'uses' => 'AdminHorairesTypeCoursController@index']);

                Route::get('/create', ['as' => 'admin_type_cours.create', 'uses' => 'AdminHorairesTypeCoursController@create']);

                Route::post('/create', ['as' => 'admin_type_cours.store', 'uses' => 'AdminHorairesTypeCoursController@store']);

                Route::get('/{id}/edit', ['as' => 'admin_type_cours.edit', 'uses' => 'AdminHorairesTypeCoursController@edit']);

                Route::post('/{id}/edit', ['as' => 'admin_type_cours.update', 'uses' => 'AdminHorairesTypeCoursController@update']);

                Route::get('/{id}/remove', ['as' => 'admin_type_cours.remove', 'uses' => 'AdminHorairesTypeCoursController@remove']);
            });
        });
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', ['as' => 'admin_settings', 'uses' => 'AdminSettingsController@index']);

        Route::post('/edit/salle', ['as' => 'informations.update', 'uses' => 'AdminSettingsController@editSalle']);

        Route::post('/edit/user', ['as' => 'user.update', 'uses' => 'UserController@edit']);

        Route::post('/edit/user/password', ['as' => 'user.password.update', 'uses' => 'UserController@editPassword']);
    });

    Route::group(['prefix' => 'users', 'middleware' => 'role:root'], function () {
        Route::get('/', ['as' => 'admin_users', 'uses' => 'AdminUsersController@index']);

        Route::get('/create', ['as' => 'admin_users.create', 'uses' => 'AdminUsersController@create']);

        Route::post('/create', ['as' => 'admin_users.store', 'uses' => 'AdminUsersController@store']);

        Route::get('/{id}/edit', ['as' => 'admin_users.edit', 'uses' => 'AdminUsersController@edit']);

        Route::post('/{id}/edit', ['as' => 'admin_users.update', 'uses' => 'AdminUsersController@update']);

        Route::get('/{id}/activate', ['as' => 'admin_users.activate', 'uses' => 'AdminUsersController@activate']);

        Route::get('/{id}/desactivate', ['as' => 'admin_users.desactivate', 'uses' => 'AdminUsersController@desactivate']);
    });
});
