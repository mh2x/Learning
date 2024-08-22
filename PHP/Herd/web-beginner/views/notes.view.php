<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello, welcome to the notes page</p>

        <div class="mt-4">
            <?php foreach ($notes as $note): ?>
                <li><?= $note['body'] ?></li>
            <?php endforeach; ?>

        </div>
    </div>
</main>

<?php require('partials/footer.php') ?>