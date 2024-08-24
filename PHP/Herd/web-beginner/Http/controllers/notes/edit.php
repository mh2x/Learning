<?php

use Core\Database;

$id = $_GET['id'];

//Data Source Name (DSN)
$config = require(base_path("config.php"));
$db = new Database($config['database'], 'root', 'Mh2x@WLM');

$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $id
    ]
)->findOrFail();


$currentUserId = 1;
//check for authorization
authorize($note['user_id'] === $currentUserId);

view("notes/edit.view.php", [
    'heading' => "Edit Note: " . $id,
    'errors' => [],
    'note' => $note
]);
