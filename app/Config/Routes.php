<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $routes->group('api', ['filter' => 'cors:api'], function ($routes) {
//     $routes->post('auth/login', 'AuthController::login');
//     $routes->options('api', static function () {
//     });
//     $routes->options('api/(:any)', static function () {
//     });
// });

$routes->group('api', static function (RouteCollection $routes) {

    $routes->post('auth/login', 'AuthController::login');
    $routes->post('auth/logout', 'AuthController::logout', ['filter' => 'auth']);
    $routes->get('auth/check', 'AuthController::check');

    $routes->get('officer', 'AuthController::officer', ['filter' => 'auth:Officer']);
    $routes->get('manager', 'AuthController::manager', ['filter' => 'auth:Manager']);
    $routes->get('finance', 'AuthController::finance', ['filter' => 'auth:Finance']);

    $routes->group('pengajuan-officer', ['filter' => 'auth:Officer'], function ($routes) {
        $routes->get('/', 'PengajuanOfficerController::index');
        $routes->get('(:num)', 'PengajuanOfficerController::show/$1');
        $routes->post('/', 'PengajuanOfficerController::create');
        $routes->put('(:num)', 'PengajuanOfficerController::update/$1');
        $routes->delete('(:num)', 'PengajuanOfficerController::delete/$1');
    });

    $routes->group('pengajuan-manager', ['filter' => 'auth:Manager'], function ($routes) {
        $routes->get('/', 'PengajuanManagerController::index');
        $routes->get('history', 'PengajuanManagerController::history');
        $routes->post('(:num)', 'PengajuanManagerController::decision/$1');
    });

    $routes->group('pengajuan-finance', ['filter' => 'auth:Finance'], function ($routes) {
        $routes->get('/', 'PengajuanFinanceController::index');
        $routes->get('history', 'PengajuanFinanceController::history');
        $routes->post('(:num)', 'PengajuanFinanceController::decision/$1');
    });


    $routes->options('', static function () {
        // $response = response();
        // $response->setHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        //     ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
        //     ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        //     ->setStatusCode(204);

        // return $response;
    });
    $routes->options('(:any)', static function () {
    });
});
