<?php

require ROOT_PATH . '/app/models/TaskModel.class.php';

class TaskController extends Controller
{

  public function indexAction()
  {
    $taskModel = new Task;
    $allTasks = $taskModel->fetchAll();
    $this->view->allTasks = $allTasks;
  }

  public function showAction()
  {
    if (isset($this->_namedParameters['id'])) {
      $taskModel = new Task;
      $id = $this->_namedParameters['id'];  // Esto viene del Router de este 'framework'. Es la manera que tiene de pillar el parámetro task/:id del routes.php
      $taskDetail = $taskModel->fetchOne($id);
      $this->view->taskDetail = $taskDetail;
    } else {
      throw new Exception("Parámetro 'id' no encontrado.");
    }
  }

  public function createAction()
  {
    $this->view;
  }
}
