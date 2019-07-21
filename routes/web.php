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

Route::get('/', 'PodcastController@index');

Route::get('/episode/{id}', 'PodcastController@show');

Route::get('/about', function()
{
    return view('pages.about');
});

Route::get('/contact', 'ContactFormController@create');
Route::post('/contact', 'ContactFormController@store');

Route::get('/error', function()
{
    return view('pages.404');
});
