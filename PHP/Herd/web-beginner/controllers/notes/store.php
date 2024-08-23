<?php
//dd($_POST);

use Core\Validator;
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
$currentUserId = 1; //hard-coded
$errors = [];


$note = trim($_POST['body'] ?? '');

//validate the note
if (!Validator::string($note, 1, 1000)) {

    $errors['body'] = 'Note body must be between 1 and 1000 characters max!!';
}

if (!empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => "Create Note",
        'errors' => $errors
    ]);
}

//Insert to DB since validation is OK now
$db->query(
    'INSERT INTO notes(body, user_id) VALUES(:body, :user_id)',
    [
        'body' => $note,  //this is very risky, it can be anything including <script>...</script> tags
        //one solution is to sanitize it before writing or another one is to escape it when reading
        //using something like htmlspecialchars();
        'user_id' => $currentUserId
    ]
);

redirect('/notes');
