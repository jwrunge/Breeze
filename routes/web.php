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

/**
 * GET routes
 */
$router->get('/', function() {
    return redirect('/people');
});

$router->get('/people', function() {
    $people = \App\People::take(25)->get();
    return view('people')->with('people', $people);
});

$router->get('/groups', function() {
    $people = \App\People::take(25)->get();
    return view('groups')->with('people', $people);
});

$router->get('/report', function() {
    return $router->app->version();
});

/**
 * POST routes
 */
$router->post('/command/addpeoplecsv', 'Controller@handle_people_csv');
$router->post('/command/addgroupscsv', 'Controller@handle_groups_csv');
$router->post('/command/searchdb', 'Controller@searchdb');