<?php

$id = $_GET['id'];
$heading = "Note: " . $id;

//Data Source Name (DSN)
$config = require("config.php");
$db = new Database($config['database'], 'root', 'Mh2x@WLM');

$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $id
    ]
)->fetch();

if (!$note) {
    abort();
}

$currentUserId = 1;
//check for authorization
if ($note['user_id'] !== $currentUserId) {
    abort(Response::ACCESS_FORBIDDEN);
}

require "views/note.view.php";
