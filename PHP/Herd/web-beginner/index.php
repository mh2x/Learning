<?php


require_once("utils.php");
require_once("database.php");
//include("router.php");

//connect to our MySQL database using PDO

//Data Source Name (DSN)
$config = require("config.php");

$db = new Database($config['database'], 'root', 'Mh2x@WLM');
$stmt = $db->query("select * from posts");
//fetch results as assoc array 
$posts  = $stmt->fetchAll();
foreach ($posts as $post) {
    echo "<li>" . $post["title"] . "</li>";
}
