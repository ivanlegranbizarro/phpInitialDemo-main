<?php

require ROOT_PATH . '/app/models/TaskModel.class.php';

class TaskController extends Controller
{


  public function __construct(private $taskModel = new Task)
  {
  }

  public function indexAction()
  {
    $allTasks = $this->taskModel->fetchAll();
    $this->view->allTasks = $allTasks;
  }

  public function showAction()
  {
    if (isset($this->_namedParameters['id'])) {
      $id = $this->_namedParameters['id'];  // Esto viene del Router de este 'framework'. Es la manera que tiene de pillar el parámetro task/:id del routes.php
      $taskDetail = $this->taskModel->fetchOne($id);
      $this->view->taskDetail = $taskDetail;
    } else {
      throw new Exception("Parámetro 'id' no encontrado.");
    }
  }

  public function createAction()
  {
    if ($this->getRequest()->isPost()) {
      // Recupera los datos del formulario
      $name = $this->_getParam('name');
      $username = $this->_getParam('username');

      // Valida los datos antes de guardar
      if (empty($name) || empty($username)) {
        echo "El nom de la tasca i el nom d'usuari són necessaris.";
        return;
      }

      // Llama al método `save` para guardar la nueva tarea
      $taskData = [
        'name' => $name,
        'username' => $username
      ];

      if ($this->taskModel->save($taskData)) {
        echo "Tasca desada amb èxit.";
      } else {
        echo "Error en desar la tasca.";
      }
    } else {
      // Si no es POST, redirige al formulario de creación
      $this->view;
    }
  }
}
