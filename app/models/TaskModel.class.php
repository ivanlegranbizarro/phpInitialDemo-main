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

    // Obtener la fecha y hora actual para el create_time
    $currentDateTime = date('Y-m-d H:i:s');

    // Crear una nueva tarea como objeto genérico (stdClass)
    $newTask = (object) [
      'id' => $newId,
      'name' => $data['name'],
      'username' => $data['username'],
      'create_time' => $currentDateTime,
      'completed_time' => null
    ];

    // Agregar la nueva tarea a la lista de tareas
    $this->tasks[] = $newTask;

    // Intentar guardar el array actualizado de tareas en el archivo JSON
    $result = file_put_contents($this->taskFile, json_encode($this->tasks));

    // Devolver true si el resultado es válido, de lo contrario false
    return $result !== false; // file_put_contents devuelve false en caso de error
  }

  public function update($data = array())
  {

    foreach ($this->tasks as $task) {
      if ($task->id == $data['id']) {
        // Obtener la fecha y hora actual para el create_time
        $currentDateTime = date('Y-m-d H:i:s');

        // Actualizar la task
        $task->id = $data['id'];
        $task->name = $data['name'];
        $task->username = $data['username'];
        $task->create_time = $data['create_time'];

        // Guardar el array actualizado de tareas en el archivo JSON
        $result = file_put_contents($this->taskFile, json_encode($this->tasks));

        return $result !== false; // Devolver true si la actualización fue exitosa
      }
    }
  }


  public function delete($id): bool
  {
    // Buscar la tarea por ID y eliminarla
    foreach ($this->tasks as $key => $task) {
      if ($task->id == $id) {
        unset($this->tasks[$key]); // Eliminar la tarea
        break;
      }
    }

    // Guardar los cambios en el archivo o base de datos
    $result = file_put_contents($this->taskFile, json_encode(array_values($this->tasks))); // Reiniciar índices y guardar

    return $result !== false; // Devolver true si se guardó con éxito
  }
}
