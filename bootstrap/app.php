<?php 

use Respect\Validation\Validator as v;

use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Connection;
use Psr\Container\ContainerInterface as Container;

session_start();

require __DIR__ . '/../vendor/autoload.php';


$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
		'db' => [
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'school',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => '',
		]
	],

]); 

$container = $app->getContainer();

$container['db2'] = function (Container $container) {
    $settings = $container->get('settings');
    $config = [
        'driver' => 'mysql',
        'host' => $settings['db']['host'],
        'database' => $settings['db']['database'],
        'username' => $settings['db']['username'],
        'password' => $settings['db']['password'],
        'charset' => $settings['db']['charset'],
        'collation' => $settings['db']['collation'],
        'prefix' => '',
    ];
    $factory = new ConnectionFactory(new \Illuminate\Container\Container());
    return $factory->make($config);
};

$container['DBcontroller'] = function ($container) {
	return new App\Controllers\DBcontroller($container);
};



$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

$container['auth'] = function ($container) {

	return new \App\Auth\Auth;
};

$container['flash'] = function($container)
{
	return new \Slim\Flash\messages;
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
		'cache' => false,
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	$view->getEnvironment()->addGlobal('auth', [
		'check' => $container->auth->check(),
		'user' => $container->auth->user(),
		'role' => $container->auth->role(),
		'userslist' => $container->DBcontroller->getUsersList(),
		'courseslist' => $container->DBcontroller->getCoursesList(),
		'studentslist' => $container->DBcontroller->getStudentsList(),
		'enrollmentslist' => $container->DBcontroller->getEnrollmentsList(),

	]);
	$view->getEnvironment()->addGlobal('flash', $container->flash);

	return $view;
};

$container['validator'] = function ($container) {
	return new App\Validation\Validator;
};

$container['HomeController'] = function ($container) {

	return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container) {

	return new \App\Controllers\Auth\AuthController($container);
};

// $container['ImageValidator'] = function ($container) {
//     return new App\Validation\ImageValidator($container);
// };

$container['PasswordController'] = function ($container) {

	return new \App\Controllers\Auth\PasswordController($container);
};

$container['ManageController'] = function ($container) {

	return new \App\Controllers\ManageController($container);
};

$container['csrf'] = function ($container) {

	return new \Slim\Csrf\Guard;
};




$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));

$app->add(new \App\Middleware\OldInputMiddleware($container));

$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

v::with('App\\Validation\\Rules\\');

require __DIR__ . '/../app/routes.php';
