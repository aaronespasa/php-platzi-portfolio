<?php

// Initialize errors (In XAMPP it isn't necessary)
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

// Composer
require_once '../vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();


use Aura\Router\RouterContainer;
use Zend\Diactoros\Response\RedirectResponse;

// Eloquent
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get('index', '/php-platzi-portfolio/public/', [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'indexAction'
]);

$map->get('addElement', '/php-platzi-portfolio/public/element/add', [
    'controller' => 'App\Controllers\ElementsController',
    'action' => 'getAddElementAction',
    'auth' => true
]);
$map->post('saveElement', '/php-platzi-portfolio/public/element/add', [
    'controller' => 'App\Controllers\ElementsController',
    'action' => 'getAddElementAction',
    'auth' => true
]);

$map->get('addUser', '/php-platzi-portfolio/public/user/add', [
    'controller' => 'App\Controllers\UsersController',
    'action' => 'getAddUserAction',
    'auth' => true
]);
$map->post('saveUser', '/php-platzi-portfolio/public/user/add', [
    'controller' => 'App\Controllers\UsersController',
    'action' => 'getAddUserAction',
    'auth' => true
]);

$map->get('loginForm', '/php-platzi-portfolio/public/login', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'getLogin'
]);
$map->get('logout', '/php-platzi-portfolio/public/logout', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'getLogout'
]);
$map->post('auth', '/php-platzi-portfolio/public/auth', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'postLogin'
]);

$map->get('admin', '/php-platzi-portfolio/public/admin', [
    'controller' => 'App\Controllers\AdminController',
    'action' => 'getIndex',
    'auth' => true
]);


$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if (!$route) {
    echo 'No route';
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false;

    // El new va a instanciar una clase con el nombre del contenido de esta variable
    $controller = new $controllerName;

    $sessionUserId = $_SESSION['userId'] ?? null;
    if($needsAuth && !$sessionUserId) {
        $response = new RedirectResponse('/php-platzi-portfolio/public/login');
    } else {
        $response = $controller->$actionName($request);
    }


    foreach($response->getHeaders() as $name => $values) {
        foreach($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }
    http_response_code($response->getStatusCode());
    echo $response->getBody();
}
