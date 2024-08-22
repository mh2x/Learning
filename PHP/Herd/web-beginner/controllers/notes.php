<?php
$heading = "My Notes";

//Data Source Name (DSN)
$config = require("config.php");
$db = new Database($config['database'], 'root', 'Mh2x@WLM');

$notes = $db->query('select * from notes where user_id=1')->get();

require "views/notes.view.php";
