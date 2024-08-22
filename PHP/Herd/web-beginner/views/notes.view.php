<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello, welcome to the notes page</p>

        <div class="mt-4">
            <ul>
                <?php foreach ($notes as $note): ?>
                    <a href="/note?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline">
                        <li><?= $note['body'] ?></li>
                    </a>
                <?php endforeach; ?>
            </ul>

            <P class="mt-6">
                <a href="/notes/create" class="text-blue-500 hover:underline">Add New Note</a>
            </P>
        </div>
    </div>
</main>

<?php require('partials/footer.php') ?>