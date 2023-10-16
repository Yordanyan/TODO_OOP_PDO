<?php

$connection = require_once ('../app/Connection.php');

$id = $_POST['id'] ?? '';

if($id){
    $connection->updateNotes($_POST['id'],$_POST);
}else{
    $connection->addNotes($_POST);
}


header("Location: index.php");

