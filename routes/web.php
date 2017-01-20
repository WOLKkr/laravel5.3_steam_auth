<?php

Route::get('/', 'IndexController@index');

Route::get('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/callback', 'AuthController@callback');