<?php

// Initialize errors (In XAMPP it isn't necessary)
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

// Composer
require_once '../vendor/autoload.php';

// Eloquent
use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cursophp',
    'username'  => 'root',
    'password'  => '',
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
    'action' => 'getAddElementAction'
]);
$map->post('saveElement', '/php-platzi-portfolio/public/element/add', [
    'controller' => 'App\Controllers\ElementsController',
    'action' => 'getAddElementAction'
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

function printElement($element) {
    // if($element->visible == false) {
    //     return;
    // }

    echo '<li class="work-position">';
          echo '<h5>' . $element->title . '</h5>';
          echo '<p>' . $element->description . '</p>';
        //   echo '<p>' . $element->months . '</p>';
          echo '<p>' . $element->getDurationAsString() . '</p>';
          echo '<strong>Achievements:</strong>';
          echo '<ul>';
            echo '<li>This is the first achievement.</li>';
            echo '<li>This is the second achievement.</li>';
          echo'</ul>';
    echo '</li>';
 }

if (!$route) {
    echo 'No route';
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];

    // El new va a instanciar una clase con el nombre del contenido de esta variable
    $controller = new $controllerName;
    $controller->$actionName($request);
}
