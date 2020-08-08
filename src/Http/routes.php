<?php
// Namespace all of the routes for this package.
Route::group([
    'namespace'  => 'Lvlo\Rules\Http\Controllers',
    'middleware' => ['web', 'locale'],   // Web middleware for state etc since L5.3
], function() {
    include __DIR__ . '/Routes/Rules.php';
});