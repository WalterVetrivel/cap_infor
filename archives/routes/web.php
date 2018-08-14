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

Auth::routes();

Route::get('/', 'ArchiveController@index')->name('home');
Route::get('/home', 'ArchiveController@index')->name('home');
Route::get('/archives', 'ArchiveController@archives')->name('archives');
Route::get('/single/{id}', 'ArchiveController@single')->name('single');
Route::get('/search', 'ArchiveController@search')->name('search');

Route::get('/new_post', 'ArchiveController@new_post')->name('new_post')->middleware('auth')->middleware('is_admin');
Route::get('/requests', 'ArchiveController@requests')->name('requests')->middleware('auth')->middleware('is_admin');

Route::get('/forbidden', 'ArchiveController@forbidden')->name('forbidden');

Route::post('/add_post', 'ArchiveController@add_post')->name('add_post')->middleware('auth')->middleware('is_admin');
Route::post('/approve/{id}', 'ArchiveController@approve')->name('approve')->middleware('auth')->middleware('is_admin');
Route::post('/reject/{id}', 'ArchiveController@reject')->name('reject')->middleware('auth')->middleware('is_admin');

Route::post('logout', 'ArchiveController@logout')->name('logout');
