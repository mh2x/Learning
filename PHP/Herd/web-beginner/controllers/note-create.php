<?php
$heading = "Create Note";

//Data Source Name (DSN)
$config = require("config.php");
$db = new Database($config['database'], 'root', 'Mh2x@WLM');
$currentUserId = 1; //hard-coded

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    //dd($_POST);
    $note = trim($_POST['body']);

    //validate the note
    if (strlen($note) < 1) {
        $errors['body'] = 'Note text cannot be empty!';
    }
    else if (strlen($note) > 1000)
    {
        $errors['body'] = 'Note text cannot exceed 1000 character!';
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


require "views/note-create.view.php";
