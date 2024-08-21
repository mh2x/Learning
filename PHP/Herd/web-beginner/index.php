<?php


require_once("utils.php");
require_once("database.php");
//include("router.php");

//connect to our MySQL database using PDO

//Data Source Name (DSN)
$config = require("config.php");


$db = new Database($config['database'], 'root', 'Mh2x@WLM');
//check if we're filtering by id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->query("select * from posts where id = ?", [$id]);
    $post  = $stmt->fetch();
    dd($post);
} else {
    $stmt = $db->query("select * from posts");
    //fetch results as assoc array 
    $posts  = $stmt->fetchAll();
    foreach ($posts as $post) {
        echo "<li>" . $post["title"] . "</li>";
    }
}
