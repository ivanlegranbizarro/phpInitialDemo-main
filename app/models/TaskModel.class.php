<?php

class Task extends Model
{

  protected string $taskFile = ROOT_PATH . '/app/db/tasks.json';
  protected array $tasks;

  public function __construct()
  {
    if (!is_dir(ROOT_PATH . '/app/db/')) {
      mkdir(ROOT_PATH . '/app/db/', 0755, true);
    }
    $this->loadTasks(); // Load tasks from JSON
  }

  private function loadTasks(): void
  {
    if (!file_exists($this->taskFile)) {
      // Archivo JSON no existe, crear uno vacío
      file_put_contents($this->taskFile, json_encode([]));
    }

    $jsonString = file_get_contents($this->taskFile);
    $this->tasks = json_decode($jsonString, false) ?? [];
  }

  public function fetchAll(): array
  {
    return $this->tasks;
  }

  public function fetchOne($id)
  {
    foreach ($this->tasks as $task) {
      if ($task->id == $id) {
        return $task;
      }
    }
  }

  public function save($data = array()): bool
  {
    // Asignar un nuevo ID basado en el tamaño del array actual
    $newId = count($this->tasks) + 1;

    // Crear una nueva tarea como objeto genérico (stdClass)
    $newTask = (object) [
      'id' => $newId,
      'name' => $data['name'],
      'description' => $data['description']
    ];

    // Agregar la nueva tarea a la lista de tareas
    $this->tasks[] = $newTask;

    // Intentar guardar el array actualizado de tareas en el archivo JSON
    $result = file_put_contents($this->taskFile, json_encode($this->tasks));

    // Devolver true si el resultado es válido, de lo contrario false
    return $result !== false; // file_put_contents devuelve false en caso de error
  }

  public function delete($id): bool
  {
    foreach ($this->tasks as $key => $task) {
      if ($task->id === $id) {
        unset($this->tasks[$key]);
        return true;
      }
      return false;
    }
  }
}
