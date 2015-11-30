<?php
namespace Pigeon\Frontend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Регистрация автозагрузчика, специфичного для текущего модуля
     */
    public function registerAutoloaders(\Phalcon\DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Pigeon\Frontend\Controllers' => '../apps/frontend/controllers/',
                'Pigeon\Frontend\Models'      => '../apps/frontend/models/',
            )
        );

        $loader->register();
    }

    /**
     * Регистрация специфичных сервисов для модуля
     */
    public function registerServices(DiInterface $di)
    {
        // Регистрация диспетчера
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Pigeon\Frontend\Controllers");
            return $dispatcher;
        });

        // Регистрация компонента представлений
        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir('../apps/frontend/views/');
            return $view;
        });
    }
}