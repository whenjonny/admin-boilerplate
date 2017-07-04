<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('home', 'FrontendController@index');
Route::get('lang/{lang}', 'LanguageController@swap');

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

/*
 * Boilerplate Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'middleware' => 'admin'], function () {
    require_once(__DIR__.'/admin.php');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');
});

$router->get( '/_debugbar/assets/stylesheets', '\Barryvdh\Debugbar\Controllers\AssetController@css' )->name('debugbar.assets.css');;
$router->get( '/_debugbar/assets/javascript', '\Barryvdh\Debugbar\Controllers\AssetController@js' )->name('debugbar.assets.js');

