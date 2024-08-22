<?php
$heading = "Create Note";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    dd($_POST);
}

//Data Source Name (DSN)
$config = require("config.php");
$db = new Database($config['database'], 'root', 'Mh2x@WLM');

require "views/note-create.view.php";
