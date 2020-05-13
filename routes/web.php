<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


//Film Route
$router->get('film/list', 'FilmController@index'); //Show all
$router->get('film/top/{total}', 'FilmController@topFilm'); //Show rated
$router->get('film/{id}', 'FilmController@show'); //Show data by id
$router->get('film', 'FilmController@filterFilm'); //Search: title, producer, studio
$router->post('film', 'FilmController@store'); //Send data: title, story, status, duration, category, production, producer, banner (all string kecuali duration:integer)
$router->put('film/{id}', 'FilmController@update'); //Update data: title, story, status, duration, category, production, producer, banner (all string kecuali duration:integer)
$router->delete('film/{id}', 'FilmController@destroy'); //Delete data by id

//Category Route
$router->get('category/list', 'CategoryController@index'); //Show all
$router->get('category/top/', 'CategoryController@topCategory'); //Show Top Category
$router->get('category/{id}', 'CategoryController@show'); //Show data by id
$router->get('category', 'CategoryController@filterCategory'); //Search: category
$router->post('category', 'CategoryController@store'); //Send data: name (string)
$router->put('category/{id}', 'CategoryController@update'); //Update data: name (string)
$router->delete('category/{id}', 'CategoryController@destroy'); //Delete data by id

//Studio Route
$router->get('studio/list', 'StudioController@index');
$router->get('studio/{id}', 'StudioController@show');
$router->post('studio', 'StudioController@store');
$router->put('studio/{id}', 'StudioController@update');
$router->delete('studio', 'StudioController@destroy');

// //Season Route
// $router->get('season/list', 'SeasonController@index');
// $router->post('season', 'SeasonController@store');
// $router->put('season/{id}', 'SeasonController@update');
// $router->delete('season', 'SeasonController@destroy');
