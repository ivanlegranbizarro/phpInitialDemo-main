<?php

require ROOT_PATH . '/app/models/TaskModel.class.php';

class TaskController extends Controller
{

  public function indexAction()
  {
    $taskModel = new Task;
    $allTasks = $taskModel->getAllTasks();
    return $this->view->tasks = $allTasks;
  }
}
