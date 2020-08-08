<?php

Route::get('/rules', [
    'as'   => 'rules.show',
    'uses' => 'RulesController@show',
]);


Route::get('/rules/list', [
    'as'   => 'rules.list',
    'uses' => 'RulesController@listRules',
]);

Route::post('/rules/store', [
    'as'   => 'rules.store',
    'uses' => 'RulesController@store',
]);

Route::get('/rules/create', [
    'as'   => 'rules.create',
    'uses' => 'RulesController@create',
]);

Route::get('/rules/edit/{rule}', [
    'as'   => 'rules.edit',
    'uses' => 'RulesController@edit',
]);

Route::post('/rules/edit/{rule}', [
    'as'   => 'rules.edit.post',
    'uses' => 'RulesController@update',
]);

Route::get('/rules/delete/{rule}', [
    'as'   => 'rules.delete',
    'uses' => 'RulesController@remove',
]);


Route::get('/rules/{lang}', [
    'as'   => 'rules.show_lang',
    'uses' => 'RulesController@showLang',
]);