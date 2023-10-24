<?php
namespace TaskTest\Controller;


use Task\Model\TaskTable;
use Task\Model\Task;
use Zend\ServiceManager\ServiceManager;
use Task\Controller\TaskController;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Prophecy\Argument;

class TaskControllerTest extends AbstractHttpControllerTestCase
{

    protected $traceError = true;
    protected $taskTable;

    public function setUp(): void
    {
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            // Grabbing the full application configuration:
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));
        parent::setUp();
        $this->configureServiceManager($this->getApplicationServiceLocator());
    }

    public function testIndexActionCanBeAccessed()
    {

        $this->taskTable->fetchAll()->willReturn([]);

        $this->dispatch('/task');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Task');
        $this->assertControllerName(AlbumController::class);
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task');
    }

    public function testAddActionRedirectsAfterValidPost()
    {
        $this->taskTable
            ->saveTask(Argument::type(Task::class))
            ->shouldBeCalled();
    
        $postData = [
            'title'  => 'Teste I',
            'description' => 'Teste de descrição',
            'creation_date' => date('Y-m-d h:m:s'),
            'status' => 0,
            'id'     => '',
        ];
        $this->dispatch('/task/add', 'POST', $postData);
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/task');
    }

    protected function configureServiceManager(ServiceManager $services)
    {
        $services->setAllowOverride(true);
    
        $services->setService('config', $this->updateConfig($services->get('config')));
        $services->setService(TaskTable::class, $this->mockTaskTable()->reveal());
    
        $services->setAllowOverride(false);
    }
    
    protected function updateConfig($config)
    {
        $config['db'] = [];
        return $config;
    }
    
    protected function mockTaskTable()
    {
        $this->taskTable = $this->prophesize(TaskTable::class);
        return $this->taskTable;
    }

}