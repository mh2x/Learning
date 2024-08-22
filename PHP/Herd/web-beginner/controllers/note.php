<?php

$id = $_GET['id'];
$heading = "Note: " . $id;

//Data Source Name (DSN)
$config = require("config.php");
$db = new Database($config['database'], 'root', 'Mh2x@WLM');

$note = $db->query(
    'select * from notes where user_id = :user and id = :id',
    [
        'user' => 1,
        'id' => $id
    ]
)->fetch();

if (!$note) {
    abort();
}

require "views/note.view.php";
