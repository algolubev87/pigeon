<?php
namespace Pigeon\Backend;

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
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Pigeon\Backend\Controllers' => '../apps/backend/controllers/',
                'Pigeon\Backend\Models'      => '../apps/backend/models/',
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
            $dispatcher->setDefaultNamespace("Pigeon\Backend\Controllers");
            return $dispatcher;
        });

        // Регистрация компонента представлений
        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir('../apps/backend/views/');
            return $view;
        });
    }
}