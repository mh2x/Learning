<?php

//The PATCH method is used for partial updates. 
//It only requires the client to send the fields that need to be updated, 
//without affecting other parts of the resource. 
//PATCH requests are also idempotent under certain conditions, but they are not required to be. 
//This method is more efficient in terms of bandwidth because it doesn't require sending the entire resource.

//PUT method is idempotent and should always update/create the same resource 
//Whereas POST can be used to insert / create multiple resources

use Core\Validator;
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
$currentUserId = 1; //hard-coded
$errors = [];


$id = $_POST['id'];
$body = trim($_POST['body'] ?? '');

//validate the note
if (!Validator::string($body, 1, 1000)) {

    $errors['body'] = 'Note body must be between 1 and 1000 characters max!!';
}

if (!empty($errors)) {
    return view("notes/edit.view.php", [
        'heading' => "Edit Note",
        'errors' => $errors
    ]);
}

//Insert to DB since validation is OK now
$db->query(
    'update notes set body = :body where id = :id',
    [
        'body' => $body,  //this is very risky, it can be anything including <script>...</script> tags
        //one solution is to sanitize it before writing or another one is to escape it when reading
        //using something like htmlspecialchars();
        'id' => $id
    ]
);

redirect('/notes');
