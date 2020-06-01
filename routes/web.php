<?php

use Illuminate\Support\Facades\Route;

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
// CUSTOM ROUTES
Route::get('/', 'PodcastController@getAllEpisodes');
// Route::get('/episode/{id}', 'PodcastController@show');

Route::get('/about', function()
{
	return view('pages.about');
});

Route::get('/contact', function()
{
	return view('contact.create');
});

// Route::get('/contact', 'ContactFormController@create');
// Route::post('/contact', 'ContactFormController@store');
// Route::get('/thank-you', function()
// {
// 	return view('contact.thank-you');
// });
