<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// | ====================================================
// | ************ Rotas Referente a API  ****************

Route::namespace('Api')->group(function()
{

    // | Jornalistas
    Route::post('/login','JournalistController@login');
    Route::post('/register','JournalistController@register');

    Route::group(['middleware' => 'jwt.auth'], function(){

        // | Jornalistas
        Route::post('/me','JournalistController@me');

        // | Notícias 
        Route::prefix('/news')->group(function()
        {
            Route::get('/me','NewsController@me');
            Route::get('/type/{id_type_news}','NewsController@newsByType');
            Route::post('/create','NewsController@create');
            Route::post('/update/{id}','NewsController@update');
            Route::post('/delete/{id}','NewsController@delete');
        
        });

        // | Tipo de Notícias
        Route::prefix('/type')->group(function()
        {
            Route::get('/me','TypeNewsController@me');
            Route::post('/create','TypeNewsController@create');
            Route::post('/update/{id}','TypeNewsController@update');
            Route::post('/delete/{id}','TypeNewsController@delete');
        
        });

    });
 

});
