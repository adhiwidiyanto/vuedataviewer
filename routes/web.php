<?php

Route::get('/', 'CustomersController@index');

Route::get('api/customer', 'CustomersController@getData');
