<?php

$connection = require_once ('../app/Connection.php');

$connection->deleteNotes($_POST['id']);

header("Location: index.php");

