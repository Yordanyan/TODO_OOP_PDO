<?php
require_once ('../vendor/autoload.php');

$connection = require_once '../app/Connection.php';
$notes = $connection->getNotes();

$currentNote = [
        'id' => '',
        'title' => '',
        'description' => ''
];

if(isset($_GET['id'])){
    $currentNote =  $connection->getNoteById($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
<div>
    <form class="new-note" action="action.php" method="post">
        <input type="hidden" name="id" value="<?= $currentNote['id']; ?>" >
        <label>Title</label>
        <input type="text" name="title" autocomplete="off" value="<?= $currentNote['title']; ?>">
        <label>Description</label>
        <textarea name="description" cols="30" rows="4"><?= $currentNote['description']; ?>
        </textarea>
        <button>
            <?php if(isset($_GET['id'])): ?>
                Update Note
            <?php else: ?>
                New Note
            <?php endif; ?>

        </button>
    </form>
    <?php
    foreach ($notes as $note): ?>
     <div class="notes">
        <div class="note">
            <div class="title">
                <a href="?id=<?= $note['id']?>"><?= $note['title']; ?></a>
            </div>
            <div class="description">
                <?= $note['description']; ?>
            </div>
            <small><?= $note['date']; ?></small>
            <form action="delete.php" method="post">
                <input type="hidden" name="id" value="<?= $note['id']; ?>" >
                <button class="close">X</button>
            </form>
        </div>
    </div>
    <?php endforeach;?>
</div>
</body>
</html>