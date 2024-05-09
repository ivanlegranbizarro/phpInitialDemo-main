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
    // Asegúrate de que el parámetro 'id' ha sido pasado correctamente
    if (isset($this->_namedParameters['id'])) {
      $taskModel = new Task;
      $id = $this->_namedParameters['id'];  // Obtén el parámetro del Router
      $taskDetail = $taskModel->fetchOne($id);
      $this->view->taskDetail = $taskDetail;
    } else {
      throw new Exception("Parámetro 'id' no encontrado.");
    }
  }
}
