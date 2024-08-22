<?php
require 'validator.php';
$config = require("config.php");

$heading = "Create Note";

//Data Source Name (DSN)
$db = new Database($config['database'], 'root', 'Mh2x@WLM');
$currentUserId = 1; //hard-coded

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    //dd($_POST);

    $note = trim($_POST['body']);

    //validate the note
    if (!Validator::string($note, 1, 1000)) {

        $errors['body'] = 'Note body must be between 1 and 1000 characters max!!';
    }

    //Insert to DB if validation is OK
    if (empty($errors)) {
        $db->query(
            'INSERT INTO notes(body, user_id) VALUES(:body,:user_id)',
            [
                'body' => $note,  //this is very risky, it can be anything including <script>...</script> tags
                //one solution is to sanitize it before writing or another one is to escape it when reading
                //using something like htmlspecialchars();
                'user_id' => $currentUserId
            ]
        );
    }
}


require "views/notes/create.view.php";
