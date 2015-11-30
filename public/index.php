<?php
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;

$di = new FactoryDefault();

// Специфичные роуты для модуля
// More information how to set the router up https://docs.phalconphp.com/ru/latest/reference/routing.html
$di->set('router', function () {

    $router = new Router(false);

    $router->setDefaultModule("frontend");

   $router->add(
    "/",
    array(
        'controller' => 'index',
        'action'     => 'index'
    )
);
    return $router;
});

try {

    // Создание приложения
    $application = new Application($di);

    // Регистрация установленных модулей
    $application->registerModules(
        array(
            'frontend' => array(
                'className' => 'Pigeon\Frontend\Module',
                'path'      => '../apps/frontend/Module.php',
            )/*,
            'backend'  => array(
                'className' => 'Pigeon\Backend\Module',
                'path'      => '../apps/backend/Module.php',
            )*/
        )
    );
//Setup a base URI so that all generated URIs include the "tutorial" folder

    // Обработка запроса
    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}