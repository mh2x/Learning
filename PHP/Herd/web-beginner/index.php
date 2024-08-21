<?php


require_once("utils.php");
include("router.php");

//connect to our MySQL database using PDO

//Data Source Name (DSN)
$dsn = "mysql:host=localhost;port=3306;dbname=webbeginner;user=root;password=Mh2x@WLM;charset=utf8mb4";
$pdo = new PDO($dsn);

//prepare a new query
$stmt = $pdo->prepare("select * from posts");
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo "<li>" . $post["title"] . "</li>";
}
