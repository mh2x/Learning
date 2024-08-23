<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

$id = $_GET['id'];
$currentUserId = 1;

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
