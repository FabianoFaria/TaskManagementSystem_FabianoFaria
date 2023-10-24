<?php
namespace Task\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Task\Form\TaskForm;
use Task\Model\Task;
use Task\Model\TaskTable;

class TaskController extends AbstractActionController
{
    private   $table;

    public function __construct(TaskTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'tasks' => $this->table->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new TaskForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $task = new Task();
        $form->setInputFilter($task->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $task->exchangeArray($form->getData());
        $this->table->saveAlbum($task);
        return $this->redirect()->toRoute('task');
    }

    public function editAction()
    {
        return new ViewModel([
            'message' => "edit teste"
        ]);

    }

    public function deleteAction()
    {
        return new ViewModel([
            'message' => "delete teste"
        ]);
    }

}