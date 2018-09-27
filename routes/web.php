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

Route::get('/', function () { return view('welcome'); });

// LISTS ROUTES
Route::post('/contacts/addList', 'ContactsController@storeList');
Route::get('/contacts/add', 'ContactsController@addContact');
Route::get('/contacts/import', 'ContactsController@import');
Route::post('/contacts/uploadFile', 'ContactsController@uploadCSVFile');
Route::get('/contacts/destroyList/{list_name}', 'ContactsController@destroyList');
Route::get('/contacts/export', 'ContactsController@export');

// HELP ROUTES
Route::get('/help', 'PagesController@help');

// CAMPAIGN ROUTES
// Route::get('/campaign', 'PagesController@campaign');
// Route::get('/campaign/create', 'PagesController@create');
// Route::get('/campaign/template', 'PagesController@template');
// Route::get('/campaign/list', 'PagesController@selectList');
Route::get('/updateTable', 'CampaignsController@updateTable');
Route::get('/tracker', 'PagesController@tracker');
Route::get('/campaigns/export/{id}', 'CampaignsController@export');

Route::get('/statistics/category/{type}', 'StatisticsController@individual');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// CONTROLLER ROUTES
Route::resource('campaigns', 'CampaignsController');
Route::resource('contacts', 'ContactsController');
Route::resource('templates', 'TemplatesController');
Route::resource('statistics', 'StatisticsController');

