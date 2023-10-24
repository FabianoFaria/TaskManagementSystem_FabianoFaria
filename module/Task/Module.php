<?php
namespace Task;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Task\Model\Task;
use Task\Model\TaskTable;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Task\Model\TaskTable' =>  function($sm) {
                    $tableGateway = $sm->get('TaskTableGateway');
                    $table = new TaskTable($tableGateway);
                    return $table;
                },
                'TaskTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Task());
                    return new TaskTableGateway('Task', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );

        // return [
        //     'factories' => [
        //         Model\TaskTable::class => function($container) {
        //             $tableGateway = $container->get(Model\TaskTableGateway::class);
        //             return new Model\TaskTable($tableGateway);
        //         },
        //         Model\TaskTableGateway::class => function ($container) {
        //             $dbAdapter = $container->get(AdapterInterface::class);
        //             $resultSetPrototype = new ResultSet();
        //             $resultSetPrototype->setArrayObjectPrototype(new Model\Task());
        //             return new TableGateway('task', $dbAdapter, null, $resultSetPrototype);
        //         },
        //     ],
        // ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\TaskController::class => function($container) {
                    return new Controller\TaskController(
                        $container->get(Model\TaskTable::class)
                    );
                },
            ],
        ];
    }
}
