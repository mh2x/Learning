<?php

use Core\Database;

$id = $_GET['id'];
$currentUserId = 1;

//Data Source Name (DSN)
$config = require(base_path("config.php"));
$db = new Database($config['database'], 'root', 'Mh2x@WLM');

$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $id
    ]
)->findOrFail();


//check for authorization
authorize($note['user_id'] === $currentUserId);

//Delete it 
$db->query(
    'delete from notes where id = :id',
    [
        'id' => $id
    ]
);

header('location: /notes');
exit();
