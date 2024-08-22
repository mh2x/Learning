<?php
//Data Source Name (DSN)
$config = require(base_path("config.php"));
$db = new Database($config['database'], 'root', 'Mh2x@WLM');

$notes = $db->query('select * from notes where user_id=1')->get();

view("notes/index.view.php", [
    "heading" => 'My Notes',
    'notes' => $notes
]);
