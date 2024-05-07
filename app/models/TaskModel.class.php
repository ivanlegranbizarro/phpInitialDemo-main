<?php

class Task
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

  public function getAllTasks(): array
  {
    return $this->tasks;
  }
}
