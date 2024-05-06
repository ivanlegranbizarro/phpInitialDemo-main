<?php

class Task extends Model
{

  public function __construct()
  {
    parent::__construct();
    $this->_setTable('tasks');
  }

  public function getAllTasks()
  {
    $sql = 'SELECT * FROM ' . $this->_table;
    $statement = $this->_dbh->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_OBJ);
  }
}
