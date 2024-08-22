<?php require("partials/head.php");  ?>
<?php require("partials/nav.php"); ?>
<?php require("partials/banner.php"); ?>


<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="font-bold text-lg">Hello, Welcome to my home page.</h1>

    </div>
    <div class="p-10 m-8 flex flex-col text-2xl">
        <p class="text-blue-500 font-bold mb-4">Using MySQL via PDO Example:</p>

        <?php
        //connect to our MySQL database using PDO

        //Data Source Name (DSN)
        $config = require("config.php");
        $db = new Database($config['database'], 'root', 'Mh2x@WLM');
        //check if we're filtering by id
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $db->query("select * from posts where id = ?", [$id]);
            $post = $stmt->findOrFail();
            dd($post);
            echo "<li>" . $post["title"] . "</li>";
        } else {
            $stmt = $db->query("select * from posts");
            //fetch results as assoc array
            $posts = $stmt->get();
            foreach ($posts as $post) {
                echo "<li>" . $post["title"] . "</li>";
            }
        }
        ?>

    </div>
</main>

<?php require("partials/footer.php");  ?>