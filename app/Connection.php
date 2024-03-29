<?php

namespace App;

use PDO;

class Connection
{
    public PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO('mysql:server=localhost;dbname=notes','root','root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function getNotes(){
        $statement = $this->pdo->prepare("SELECT * FROM notes ORDER BY date DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNotes($note){
        $statement = $this->pdo->prepare("INSERT INTO `notes`(`title`, `description`) VALUES (:title,:description)");
        $statement->bindValue('title',$note['title']);
        $statement->bindValue('description',$note['description']);
        return $statement->execute();

    }

    public function getNoteById($id){
        $statement = $this->pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $statement->bindValue('id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNotes($id,$note){
        $statement = $this->pdo->prepare("UPDATE `notes` SET title = :title, description = :description WHERE id = :id");
        $statement->bindValue('title',$note['title']);
        $statement->bindValue('description',$note['description']);
        $statement->bindValue('id',$id);
        return $statement->execute();
    }

    public function deleteNotes($id){
        $statement = $this->pdo->prepare("DELETE FROM `notes` WHERE id = :id");
        $statement->bindValue('id',$id);
        return $statement->execute();
    }


}

return new Connection();