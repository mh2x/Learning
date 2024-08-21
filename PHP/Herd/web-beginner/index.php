<?php


require_once("utils.php");
require_once("database.php");
//include("router.php");

//connect to our MySQL database using PDO

//Data Source Name (DSN)
$db = new Database("mysql:host=localhost;port=3306;dbname=webbeginner;user=root;password=Mh2x@WLM;charset=utf8mb4");
$stmt = $db->query("select * from posts");
//fetch results as assoc array 
$posts  = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($posts as $post) {
    echo "<li>" . $post["title"] . "</li>";
}
