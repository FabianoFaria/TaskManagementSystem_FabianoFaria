<?php

namespace Task\Factory;

use Task\Controller\TaskController;
use Task\Model\PostRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TaskControllerFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return TaskController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controllerPluginManager = $serviceLocator;
        $serviceManager = $controllerPluginManager->get('ServiceManager');
        $taskTable = $serviceManager->get('Task\Model\TaskTable');
        return new  TaskController($taskTable);
    }
}